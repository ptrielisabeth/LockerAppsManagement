<?php
session_start();
error_reporting(0);
include("../../theme/config.php");


$plant= $_POST['plant'];


$areaResult = join("','", $_POST['area']);
$floorResult = join("','", $_POST['floor']);
$deptResult = join("','", $_POST['dept']);

?>

<div class="row card-body">
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
                    FROM [SERE].[dbo].[tbl_locker] 
                    where plant ='$plant' and (area IN ('$areaResult') OR area is null) and (floor IN ('$floorResult') OR floor is null) and (dept IN ('$deptResult') OR dept is null) Order By Locker_ID offset $offset rows fetch next $next rows only";
                        // echo $a;
                    $actionsum= sqlsrv_query($conn, $a);
                    $no=1;
                    $pass = false;
                    while ($r = sqlsrv_fetch_array($actionsum)) { 
                    $pass=true;
                    $offset = $offset+1;
                    ?>
                    <div class="row">
                        <div style='margin-bottom: 10px;'  method="post" data0="<?php echo $r['locker_id']; ?>" data1="<?php echo $r['name']; ?>" data2="<?php echo $r['talent_id']; ?>" data3="<?php echo $r['gender']; ?>" data4="<?php echo $r['plant']; ?>" data5="<?php echo $r['area']; ?>" data6="<?php echo $r['dept']; ?>" data7="<?php echo $r['no_phone']; ?>"onclick="editDelete($(this).attr('data0'), $(this).attr('data1'), $(this).attr('data2'), $(this).attr('data3'), $(this).attr('data4'), $(this).attr('data5'), $(this).attr('data6'), $(this).attr('data7'));">
                            <div align="center" data-target="#ModalDetailGambar" class='border border-5 border-dark'>
                                <?php if ($r['area'] != '2'){ ?>
                                <img style="width:100%;" src="img/office.png" width="50vw" alt="Office . . ."/>
                                <?php } else{ ?>
                                <img style="width: 100%;" src="img/suboffice.png" width="50vw" alt="Sub Office . . ."/>
                                <?php } ?>
                            </div>
                            <div class="<?php if($r['talent_id'] != NULL){ echo 'bg-danger';} else { echo 'bg-success';} ?> text-center text-bold" width="70vw" style='white-space: nowrap;' ><?php echo $r['locker_id'] ?> (<?php echo $r['dept'] ?>)</div>
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
        <div class="modal-dialog modal-md">
        <div class="modal-header box-solid bg-green">
            <h4 class="modal-title" id="memberModalLabel">Data Locker</h4>
            <button type="button" class="close" data-dismiss="modal"><span
                    aria-hidden="true">&times;</span><span
                    class="sr-only">Close</span></button>
            </div>
            <div class="modal-content">
                    <div class="modal-body"  >
                        <div class="form-group row">
                            <label class="col-sm-3"></label>
                            <div class="col-sm-7">
                            <?php
                            $result = sqlsrv_query($conn, "SELECT * FROM tbl_locker WHERE locker_id = '" . $id . "'");
                            $data = sqlsrv_fetch_array($result) ?>
                            <div class="row">
                                <div class="col-md-12">
                                    
                                    <a class="button" id="<?php echo $data['locker_id']; ?>">
                                        <img src="/imgprofile/<?php echo $data['img']; ?>" width="100px" height="100px" />
                                    </a>
                                 
                            </div>
                            </div>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-sm-3">Locker ID</label>
                            <div class="col-sm-7">
                                <input disabled id="lockerid1" class="form-control" name="locker_id"></input>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-sm-3">Name</label>
                            <div class="col-sm-7">
                                <input disabled id="name1" class="form-control" name="name"></input>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3">Talent ID</label>
                            <div class="col-sm-7">
                                <input disabled id="talentid1" class="form-control" name="talent_id"></input>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3">Gender</label>
                            <div class="col-sm-7">
                                <input disabled id="gender1" class="form-control" name="gender"></input>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3">Plant</label>
                            <div class="col-sm-7">
                                <input disabled id="plant1" class="form-control" name="plant"></input>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3">Area</label>
                            <div class="col-sm-7">
                                <input disabled id="area1" class="form-control" name="area"></input>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3">Department</label>
                            <div class="col-sm-7">
                                <input disabled id="dept1" class="form-control" name="dept"></input>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3">No.Phone</label>
                            <div class="col-sm-7">
                                <input disabled id="nophone1" class="form-control" name="no_phone"></input>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button data-dismiss="modal" name="reset" class="btn-secondary btn-reset">
                                Close</button>
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

    function editDelete(a, b, c, d, e, f, g, h) {
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
