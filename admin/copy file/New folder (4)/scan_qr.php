<?php
    session_set_cookie_params(3600*3600*24*5, "/");
    session_start();
    error_reporting(0);
    include("../../theme/config.php");
    include("partial/header.php");

    $msd_plants= $_SESSION['userplant'];


    // Get idno
    $sql = "SELECT max(locker_id) as locker_id from tbl_locker";
    $sqlres = sqlsrv_query($conn, $sql);
    while ($res = sqlsrv_fetch_array($sqlres)) {
        $locker_id=$res['locker_id']+1;
    }

    // Generate data list
    $sql = "delete tbl_insp_tmp where id_no=$idno 
        insert into tbl_insp_tmp (id_no,insp_id) 
        select $idno, insp_id from mst_inspection order by insp_id";
        // echo $sql;
    $sqlquery = sqlsrv_query($conn, $sql);

    $msd_lantai= 'SNC';
    $msd_line= 'Tesys';
    $msd_cell= 'Tesys - Front Line 1';
    $msd_bench= 'TE-062 Final Tester & Dating';
    
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }
    $_head_id = 1;
    if(isset($_GET['head_id'])){
        $_head_id = $_GET['head_id'];
    }
?>

<!-- =============================================================================================CUSTOM STYLE============================================================================ -->
<style>
/* The container */
    .containercheckbox {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 22px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        text-align: center;
    } 
    span.bahasa {
        color: #32CD32;
    }

    /* Hide the browser's default checkbox */
    .containercheckbox input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    /* Create a custom checkbox */
    .checkmark, .secondcheckmarks {
        position: absolute;
        top: 0;
        left: 0;
        height: 20px;
        width: 25px;
        background-color: #E0E0E0;
    }

    /* On mouse-over, add a grey background color */
    .containercheckbox:hover input ~ .checkmark, .containercheckbox:hover input ~ .secondcheckmarks {
        background-color: #ccc;
    }

    /* When the checkbox is checked, add a blue background */
    .containercheckbox input:checked ~ .checkmark {
            background-color: #2196F3;
        }

    .containercheckbox input:checked ~ .secondcheckmarks {
        background-color: #b5bbc8  ;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after, .secondcheckmarks:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .containercheckbox input:checked ~ .checkmark:after, .containercheckbox input:checked ~ .secondcheckmarks:after {
        display: block;
    }

    /* Style the checkmark/indicator */
    .containercheckbox .checkmark:after, .containercheckbox .secondcheckmarks:after {
        left: 9px;
        top: 3px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }

    .center {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 100%;
        height: 100%;
    }
    input.mediumtext {
        width: 50px;
        height: 40px;
        font-size: 16pt;
        text-align: center;
        background-color: greenyellow;
        box-sizing: border-box;
    }
    .textright {
        width: 50px;
        height: 40px;
        font-size: 16pt;
        text-align: center;
        background-color: greenyellow;
        box-sizing: border-box;
        position: absolute;
        right: 0px;
        /*border: 3px solid #73AD21;
        padding: 10px;*/
    }
    input.largertext {
        width: 100%;
        height:120px;
        padding: 12px 20px;
        margin: 8px 0;
        box-sizing: border-box;
    }
    input.largerradio {
        width: 200px;
        height: 20px;
    }
    input.largerCheckbox {
        width: 40px;
        height: 40px;
    }
    input[type="checkbox"] {
        vertical-align:middle;
    }
    .modal {
        overflow: auto !important;
    }
    input[type="radio"] 
    {
        border: 0px;
        width: 2000px;
        height: 2em;
    }
    .button {
        /*background-color: #4CAF50; /* Green */
        border: none;
        color: blue;
        padding: 5px 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 20px;
        margin: 0px 0px;
        cursor: pointer;
        border-radius: none;
    }

</style>
<!-- =============================================================================================END CUSTOM STYLE============================================================================ -->


<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-outline">
                            <div class="card-header bg-success" style="text-align: center;">
                                <h3>Scan QR</h3>
                            </div>
                            <div class="card-body" style="min-height: 10vh" >
                                <div class="row" style="min-height: 70vh">
                                    <div style="margin: 0 auto; width:500px;">
                                        <form type='post' class="form-group mt-3" style="display: flex; flex-direction: column; width: 100%; justify-content: center;">
                                            <label for="colFormLabel"  style="text-align: center;">Scan QR </label>
                                            <input type="text" class="form-control timepicker" id="scan" name='scan' placeholder="Code">
                                            <button class='btn btn-primary btn-sm mt-2 mb-4'>Scan</button>
                                        </form>
                                        <?php
                                            $dataas = $_GET['scan'];
                                            $a= "  SELECT * FROM [SERE].[dbo].[tbl_locker] where locker_id='$dataas'";
                                                // echo $a;
                                            $actionsum= sqlsrv_query($conn, $a);
                                            $no=1;
                                            while ($r = sqlsrv_fetch_array($actionsum)) { 
                                            ?> 


                                        <div class="form-group row">
                                            <label class="d-flex justify-content-start"></label>
                                            <div>
                                                <td>
                                                        <a class="center" id="<?php echo $data['locker_id']; ?>" >
                                                            <img class='postentry' src="" width="200px" height=" 300px" />
                                                        </a>
                                                    
                                                </td>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4">Locker ID :</label>
                                            <div class="col-sm-8">
                                                <input disabled id="lockerid1" class="form-control" name="locker_id" value='<?= $r['locker_id'] ?> '></input>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-sm-4">Name :</label>
                                            <div class="col-sm-8">
                                                <input disabled id="name1" class="form-control" name="name" value='<?= $r['name'] ?>'></input>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4">Talent ID :</label>
                                            <div class="col-sm-8">
                                                <input disabled id="talentid1" class="form-control" name="talent_id" value='<?= $r['talent_id'] ?>'></input>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4">Gender :</label>
                                            <div class="col-sm-8">
                                                <input disabled id="gender1" class="form-control" name="gender" value='<?= $r['gender'] ?>'></input>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4">Plant :</label>
                                            <div class="col-sm-8">
                                                <input disabled id="plant1" class="form-control" name="plant" value='<?= $r['plant'] ?>'></input>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4">Area :</label>
                                            <div class="col-sm-8">
                                                <input disabled id="area1" class="form-control" name="area" value='<?= $r['area'] ?>'></input>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4">Department :</label>
                                            <div class="col-sm-8">
                                                <input disabled id="dept1" class="form-control" name="dept" value='<?= $r['dept'] ?>'></input>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4">No.Phone :</label>
                                            <div class="col-sm-8">
                                                <input disabled id="nophone1" class="form-control" name="no_phone" value='<?= $r['no_phone'] ?>'></input>
                                            </div>
                                        </div>       

                                        <?php
                                        }
                                        ?>
                                        <div>
                                        <!-- <label for="colFormLabel"  style="text-align: center;">Last Inspection : </label>  -->
                                        <input type="hidden" name="lastinsp" >
                                        <input type="hidden" class="form-control" type="text" id="lastinsp" placeholder="-" readonly>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



<!-- ============================================================================================================CLOSE MODAL PICTURE REFERENCES=========================================== -->

    <script src="../../theme/jquery/jquery.min.js"></script>
    <script src="../../theme/bootstrap/js/bootstrap.js"></script>
    <script src="../../theme/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../theme/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../theme/datatables/jquery.dataTables.min.js"></script>
    <script src="../../theme/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../theme/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../theme/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../../theme/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="../../theme/sweetalert/sweetalert2.min.js"></script>
    <script src="../../theme/lte/js/adminlte.min.js"></script>
    <script src="../../theme/select2/js/select2.full.js"></script>
    <script src="../../theme/select2/js/select2.js"></script>
    <script src="../../theme/selecpicker/bootstrap-select.min.js"></script>

</body>

<script>
    $('#scan').on('input', function(){
        var input=$(this).val();
        $.ajax({
            type:'POST',
            url: '',
            data: {input: input},
            success: function(data){
                $('#table_rack_inspect').html(input);
            }
        })
    })
</script>


<script>
function showmodal(id) {
        $.ajax({
            type: "POST",
            url: "map-modal.php",
            data: {
                id: id
            }
        }).done(function(response) {
            $("#ModalShow").modal("show");
            $("#list1").html(response);
        })
    }

    function editDelete(a, b, c, d, e, f, g, h, i) {
        $('.postentry').attr('src', 'imgprofile/'+i);
        $('#ModalEdit').modal('show');
        $('#lockerid1').val(a);
        console.log(a);
        $('#name1').val(b);
        $('#talentid1').val(c);
        $('#gender1').val(d);
        $('#plant1').val(e);
        $('#area1').val(f);
        $('#dept1').val(g);
        $('#nophone1').val(h);
    }

</script>
