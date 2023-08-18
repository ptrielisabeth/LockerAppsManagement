<?php
session_start();
error_reporting(0);
include("../../theme/config.php");


$plant= $_POST['plant'];


$areaResult = join("','", $_POST['area']);
$floorResult = join("','", $_POST['floor']);
$deptResult = join("','", $_POST['dept']);


?>

<div class="card-body">
    <div class="col-12 table-responsive">
    
                <table id="example1" class="table table-bordered text-center table-striped table-condensed">
                    <thead class="bg-info">
                        <tr font-size='8' align='center'>
                            <th>No</th>
                            <th>Locker ID</th>
                            <th>Name</th>
                            <th>Talent ID</th>
                            <th>Gender</th>
                            <th>Plant</th>
                            <th>Area</th>
                            <th>Floor</th>
                            <th>Department</th>
                            <th>No.Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            // $a= "  SELECT * 
                            // FROM [SERE].[dbo].[tbl_locker_data] 
                            // where plant ='$plant' and (area IN ('$areaResult') OR area is null) and (floor IN ('$floorResult') OR floor is null) and (dept IN ('$deptResult') OR dept is null)";
                            $a = "select * from [tbl_locker_data]";
                                // echo $a;
                            $actionsum = sqlsrv_query($conn, $a);
                            $no=1;
                            while ($r = sqlsrv_fetch_array($actionsum)) { 
                            ?>
                        <tr>
                        <td><?= $no++?></td>
                        <td><?= $r['locker_id'] ?></td>
                        <td><?= $r['name'] ?></td>
                            <td><?= $r['talent_id'] ?></td>
                            <td><?= $r['gender'] ?></td>
                            <td><?= $r['plant'] ?></td>
                            <td><?= $r['area'] ?></td>
                            <td><?= $r['floor'] ?></td>
                            <td><?= $r['dept'] ?></td>
                            <td><?= $r['no_phone'] ?></td>
                            <td>
                                <div class='d-inline'>
                                    <button class="btn btn-warning btn-xs d-inline  mb-2 mx-3" id="edit" name="edit" method="post" data0="<?php echo $r['locker_id']; ?>" data1="<?php echo $r['name']; ?>" data2="<?php echo $r['talent_id']; ?>" data3="<?php echo $r['gender']; ?>" data4="<?php echo $r['plant']; ?>" data5="<?php echo $r['area']; ?>" data6="<?php echo $r['floor']; ?>" data7="<?php echo $r['dept']; ?>" data8="<?php echo $r['no_phone']; ?>" data9="<?php echo $r['img']; ?>" onclick="editDelete($(this).attr('data0'), $(this).attr('data1'), $(this).attr('data2'), $(this).attr('data3'), $(this).attr('data4'), $(this).attr('data5'), $(this).attr('data6'), $(this).attr('data7'), $(this).attr('data8'), $(this).attr('data9'));"><i class="fa fa-edit"></i> &nbsp;Edit</button>           
                                </div>
                                <div class='d-inline'>
                                    <form target="_blank" method="post" action="printone_qr.php">
                                        <input type="hidden" name='id' value='http://10.155.152.114/sere-apps/sere/lockers2/admin/data_detail_lockers.php?id_loker=<?php echo $r['locker_id'] ?>'/>
                                        <button class="btn btn-success btn-xs d-inline mb-2 mx-3"><i class="fa fa-print"></i> &nbsp;Print</button>
                                    </form>
                                </div>  
                                <div class='d-inline'>
                                    <button class="btn btn-danger btn-xs d-inline  mb-2 mx-3" data-target="#ModalDelete" data-href='deletelocker.php?id=<?php echo $r['locker_id']; ?>'data-toggle="modal"><i class="fa fa-trash">&nbsp;</i>Delete</a>
                                </div>
                            </td>        
                        </tr>
                        <?php
                            }
                            ?>
                    </tbody>

                    <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog"
                            aria-labelledby="memberModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-default">
                                <div class="modal-content">
                                    <div class="modal-header box-solid bg-green"
                                    >
                                        <h4 class="modal-title" id="ModalLabel">Alert</h4>
                                        <button type="button" class="close" data-dismiss="modal"><span
                                                aria-hidden="true">&times;</span><span
                                                class="sr-only">Close</span></button>
                                    </div>
                                    <div>
                                        <div class="modal-body"> Are you sure delete this data?</div>
                                        <div class="modal-footer">
                                            <a class="btn btn-success btn-ok"><i class="fa fa-check">&nbsp;</i>Yes</a>
                                            <button type="button" class="btn btn-default" data-dismiss="modal" ><i
                                                    class="fa fa-times">&nbsp;</i>No</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    
                </table>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#ModalDelete').on('show.bs.modal', function (e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    });
</script>

<script>
    $(document).on('click','.klikkdongss',function(){
        const dataDulu = $(this).data('dulu');
        console.log(dataDulu);
        $.ajax({
            url: "printone_qr.php",
            type: "post",
            data: {
                id: dataDulu
            },
            success: function (response) {
                console.log(response);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
</script>



<script>
    $(document).ready(function() {
        $('#example1').DataTable({
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false
        })
    })
</script>

<script>

    function editDelete(x, a, b, c, d, e, f, g, h, i) {
        $('#ModalEdit').modal('show');
        $("#locker_id1").val(x);
        $('#name1').val(a);
        $('#talent_id1').val(b);
        $('#gender1').val(c).attr("selected", "selected");
        $('#plant2').val(d).attr("selected", "selected");
        $('#area2').val(e).attr("selected", "selected");
        $('#floor2').val(f).attr("selected", "selected");
        $('#dept2').val(g).attr("selected", "selected");
        $('#no_phone1').val(h);
        console.log('/imgprofile/' + i);
        $('#img1sabet').val('/imgprofile/' + i);
    }

    
</script>








