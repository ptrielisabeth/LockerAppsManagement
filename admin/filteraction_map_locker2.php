<?php
session_start();
error_reporting(0);
include("../../theme/config.php");


$plant= $_POST['plant'];


$areaResult = join("','", $_POST['area']);
$floorResult = join("','", $_POST['floor']);
$deptResult = join("','", $_POST['dept']);

?>

<div class="d-flex flex-row card-body" style="overflow-x: scroll;">
<?php
    $pass = true;
    $offset = 0;
    $next = 6;
    while ($pass)
    {
    ?>
        <div class="col-md-1 ml-2">
                <div style="cursor: grab;">
                    <?php
                        $a= "SELECT *
                        FROM [SERE].[dbo].[tbl_locker_data] 
                        where plant ='$plant' and (area IN ('$areaResult') OR area is null) and (floor IN ('$floorResult') OR floor is null) and (dept IN ('$deptResult') OR dept is null) Order By Locker_ID asc offset $offset rows fetch next $next rows only";
                            // echo $a;
                        $actionsum= sqlsrv_query($conn, $a);
                        $no=1;
                        $pass = false;
                        while ($r = sqlsrv_fetch_array($actionsum)) { 
                        $pass=true;
                        $offset = $offset+1;
                        ?>
                        <div class="row <?php if (strval($_SESSION['username']) === strval($r['talent_id'])) { echo 'blink'; } else { echo ''; } ?>">
                            <div style='margin-bottom: 10px; max-width:100px;' method="post" dataImg='<?php echo $r['img']; ?>' data0="<?php echo $r['locker_id']; ?>" data1="<?php echo $r['name']; ?>" data2="<?php echo $r['talent_id']; ?>" data3="<?php echo $r['gender']; ?>" data4="<?php echo $r['plant']; ?>" data5="<?php echo $r['area']; ?>" data6="<?php echo $r['dept']; ?>" data7="<?php echo $r['no_phone']; ?>" data80="<?php echo strval($_SESSION['iduser']); ?>" onclick="editDelete($(this).attr('data0'), $(this).attr('data1'), $(this).attr('data2'), $(this).attr('data3'), $(this).attr('data4'), $(this).attr('data5'), $(this).attr('data6'), $(this).attr('data7'), $(this).attr('dataImg'), $(this).attr('data80'));">
                                <div align="center" data-target="#ModalDetailGambar" class='border border-3 border-dark'>
                                    <?php if ($r['area'] != 'Sub Office'){ ?>
                                    <img style="width:100%;" src="img/office.png" width="20vw" alt="Office . . ."/>
                                    <?php } else{ ?>
                                    <img style="width: 100%;" src="img/suboffice.png" width="20vw" alt="Sub Office . . ."/>
                                    <?php } ?>
                                </div>
                                <div class="<?php if($r['name'] != NULL){ echo 'bg-danger text-xs';} else { echo 'bg-success text-xs';} ?> text-center text-bold" width="70vw" style='white-space: nowrap;' ><?php echo $r['locker_id'] ?> (<?php echo $r['dept'] ?>)</div>
                            </div>
                        </div>
                        <?php
                        }
                    ?>
                </div>
        </div>
     <?php } ?>       
    <!-- The Modal Edit -->       
    <div class="modal fade" id="ModalEdit"<?php echo $data['locker_id']; ?> tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-bg">
        <div class="modal-header box-solid bg-green">
            <h4 class="modal-title" id="memberModalLabel">Data Locker</h4>
            <button type="button" class="close" data-dismiss="modal"><span
                    aria-hidden="true">&times;</span><span
                    class="sr-only">Close</span></button>
            </div>
            <div class="modal-content">
                    <div class="modal-body"  >
                        <form action="./editkan_lokers.php" method="POST">
                        <div class="form-group row">
                            <label class="col-sm-3">Locker ID :</label>
                            <div class="col-sm-9">
                                <input id="lockerid2" readonly class="form-control" name="locker_id"></input>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-sm-3">Name :</label>
                            <div class="col-sm-9">
                                <input id="name2" class="form-control" name="name"></input>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3">Talent ID :</label>
                            <div class="col-sm-9">
                                <input id="talentid2" class="form-control" name="talent_id"></input>
                            </div>
                        </div>

                     
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Gender :</label>
                            <div class="col-sm-9">
                                <select id="gender2" class="form-control" name="gender">
                                    <option value="Female">Female</option>
                                    <option value="Male">Male</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3">Plant :</label>
                            <div class="col-sm-9">
                                <input id="plant2" disabled class="form-control" name="plant"></input>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3">Area :</label>
                            <div class="col-sm-9">
                                <input id="area2" disabled class="form-control" name="area"></input>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3">Department :</label>
                            <div class="col-sm-9">
                                <input id="dept2" disabled class="form-control" name="dept"></input>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3">No.Phone :</label>
                            <div class="col-sm-9">
                                <input id="nophone2" class="form-control" name="no_phone"></input>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button data-dismiss="modal" name="reset" class="btn-secondary btn btn-reset">
                                Close</button>
                        </div>
                        </form>
                </div>
            </div> 
            </div>   
        </div>
        
    <div class="modal fade" id="ModalEdit2"<?php echo $data['locker_id']; ?> tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-bg">
        <div class="modal-header box-solid bg-green">
            <h4 class="modal-title" id="memberModalLabel">Data Locker</h4>
            <button type="button" class="close" data-dismiss="modal"><span
                    aria-hidden="true">&times;</span><span
                    class="sr-only">Close</span></button>
            </div>
            <div class="modal-content">
                    <div class="modal-body"  >
                        <form action="./editkan_lokers2.php" method="POST">
                       
                        
                        <div class="form-group row">
                            <label class="col-sm-3">Locker ID :</label>
                            <div class="col-sm-9">
                                <input readonly id="lockerid1" class="form-control" name="locker_id"></input>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-sm-3">Name :</label>
                            <div class="col-sm-9">
                                <input id="name1" class="form-control" name="name"></input>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3">Talent ID :</label>
                            <div class="col-sm-9">
                                <input id="talentid1" class="form-control" name="talent_id"></input>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3">Gender :</label>
                            <div class="col-sm-9">
                                <input id="gender1" class="form-control" name="gender"></input>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3">Plant :</label>
                            <div class="col-sm-9">
                                <input disabled id="plant1" class="form-control" name="plant"></input>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3">Area :</label>
                            <div class="col-sm-9">
                                <input disabled id="area1" class="form-control" name="area"></input>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3">Department :</label>
                            <div class="col-sm-9">
                                <input disabled id="dept1" class="form-control" name="dept"></input>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3">No.Phone :</label>
                            <div class="col-sm-9">
                                <input id="nophone1" class="form-control" name="no_phone"></input>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button data-dismiss="modal" name="reset" class="btn-secondary btn btn-reset">
                                Close</button>
                        </div>
                        </form>
                </div>
            </div> 
            </div>   
        </div>             
                        
    </div>
                        
    </div>
</div>




<script>
$(document).ready(function () {
    $('#tablefilter').DataTable();
});

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

    function editDelete(a, b, c, d, e, f, g, h, i,bobi) {
        if (b != '') {
            $('#name1').prop('disabled', true)
        } else {
            $('#name1').prop('disabled', false)
        }
        if (c != '') {
            $('#talentid1').prop('disabled', true)
        } else {
            $('#talentid1').prop('disabled', false)
        }
        if (d != '') {
            $('#gender1').prop('disabled', true)
        } else {
            $('#gender1').prop('disabled', false)
        }
        if (h != '') {
            $('#nophone1').prop('disabled', true)
        } else {
            $('#nophone1').prop('disabled', false)
        }
        if (b == '') {
            $('#ModalEdit').modal('show');
        } else {
            $('#ModalEdit2').modal('show');
            if(bobi == c){
                $('#check_locker').css('display', 'flex')
            }else{
            }
        }
        if (b != '') {
            $('#name2').prop('disabled', true)
        } else {
            $('#name2').prop('disabled', false)
        }
        if (c != '') {
            $('#talentid2').prop('disabled', true)
        } else {
            $('#talentid2').prop('disabled', false)
        }
        if (d != '') {
            $('#gender2').prop('disabled', true)
        } else {
            $('#gender2').prop('disabled', false)
        }
        if (h != '') {
            $('#nophone2').prop('disabled', true)
        } else {
            $('#nophone2').prop('disabled', false)
        }
        if (b == '') {
            $('#ModalEdit').modal('show');
        } else {
            $('#ModalEdit2').modal('show');
        }
        $('.postentry').attr('src', 'imgprofile/'+i);
        $('#lockerid1').val(a);
        $('#name1').val(b);
        $('#talentid1').val(c);
        $('#gender1').val(d);
        $('#plant1').val(e);
        $('#area1').val(f);
        $('#dept1').val(g);
        $('#nophone1').val(h);
        $('#lockerid2').val(a);
        $('#name2').val(b);
        $('#talentid2').val(c);
        $('#gender2').val(d);
        $('#plant2').val(e);
        $('#area2').val(f);
        $('#dept2').val(g);
        $('#nophone2').val(h);
    }

</script>
