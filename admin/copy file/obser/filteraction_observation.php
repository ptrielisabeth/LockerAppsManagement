<?php
session_start();
error_reporting(0);
include("../../theme/config.php");


?>

<div class="card-body">
    <div class="col-12 table-responsive">
    
                <table id="example1" class="table table-bordered text-center table-striped table-condensed">
                    <thead class="bg-info">
                        <tr font-size='8' align='center'>
                            <th>No</th>
                            <th>Observation Description</th>
                            <th>Plant</th>
                            <th>Floor</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Upload</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            
                            $a = "SELECT * FROM tbl_observation";
                            // echo $a;

                            $actionsum= sqlsrv_query($conn, $a);
                            $no=1;
                            while ($r = sqlsrv_fetch_array($actionsum)) { 
                            ?>
                        <tr>
                            <td><?= $no++?></td>
                            <td><?= $r['description'] ?></td>
                            <td><?= $r['plant'] ?></td>
                            <td><?= $r['floor'] ?></td>
                            <td><?= $r['location'] ?></td>
                            <td><?= $r['status'] ?></td>
                            <td>
                                <?php
                                    if($r['img'] == "" || $r['img'] == null){
                                        echo "No Picture";
                                    }else{
                                ?>
                                    <a class="button" id="<?php echo $r['plant']; ?>" >
                                        <img src="imgprofile/<?php echo $r['img']; ?>" width="100px" height="100px" />
                                    </a>
                                <?php
                                    }
                                ?>
                            </td>

                            <td>
                                <div class='d-inline'>
                                    <button class="btn btn-primary btn-xs d-inline  mb-2 mx-3" id="edit" name="edit" method="post" data0="<?php echo $r['obserID']; ?>" data1="<?php echo $r['description']; ?>" data2="<?php echo $r['plant']; ?>" data3="<?php echo $r['floor']; ?>" data4="<?php echo $r['location']; ?>" data5="<?php echo $r['img']; ?>" data6="<?php echo $r['status']; ?>" onclick="editDelete($(this).attr('data0'), $(this).attr('data1'), $(this).attr('data2'), $(this).attr('data3'), $(this).attr('data4'), $(this).attr('data5'), $(this).attr('data6'));"><i class="fa fa-edit"></i> &nbsp;Update</button>           
                                </div>
                                <div class='d-inline'>
                                    <button class="btn btn-danger btn-xs d-inline  mb-2 mx-3" data-target="#ModalDelete" data-href='deleteobservation.php?id=<?php echo $r['obserID']; ?>'data-toggle="modal"><i class="fa fa-trash">&nbsp;</i>Delete</a>
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
                                    <div class="modal-header box-solid bg-green">
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

    $("")
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
        $("#obserID1").val(x);
        $('#description1').val(a);
        $('#plant1').val(d);
        $('#floor1').val(f).attr("selected", "selected");
        $('#location1').val(g);
        $('#img1').val(h);
        $('#status1').val(i);
    }

    
</script>








