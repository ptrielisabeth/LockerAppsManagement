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
                            <th>Date</th>
                            <th>Plant</th>
                            <th>Locker ID</th>
                            <th>Observation Description</th>
                            <th>Floor</th>
                            <th>Location</th>
                            <th>Photo</th>
                            <th>Status</th>
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
                            <td><?= date_format($r['date'],"d/m/Y "); ?></td>
                            <td><?= $r['plant'] ?></td>
                            <td><?= $r['locker_id'] ?></td>
                            <td><?= $r['description'] ?></td>
                            <td><?= $r['floor'] ?></td>
                            <td><?= $r['location'] ?></td>
                            <td>
                                <?php
                                    if($r['img'] == "" || $r['img'] == null){
                                        echo "No Picture";
                                    }else{
                                ?>
                                    <a class="button" href="#" data-target="#ModalDetailGambar" id="<?php echo $r['obserID']; ?>"  data-toggle="modal" >
                                        <img src="imgobservation/<?php echo $r['img']; ?>" width="100px" height="100px" />
                                    </a>
                                <?php
                                    }
                                ?>
                            </td>
                            <td><?= $r['status'] ?></td>
                            <td>
                                <button class="btn btn-primary btn-xs d-inline mb-2 mx-3" id="edit" name="edit" data0="<?php echo date_format($r['date'],"d/m/Y "); ?>" data1="<?php echo $r['description']; ?>" data2="<?php echo $r['locker_id']; ?>" data3="<?php echo $r['plant']; ?>" data4="<?php echo $r['floor']; ?>" data5="<?php echo $r['location']; ?>" data6="<?php echo $r['status']; ?>" onclick="editDelete($(this).attr('data0'), $(this).attr('data1'), $(this).attr('data2'), $(this).attr('data3'), $(this).attr('data4'), $(this).attr('data5'), $(this).attr('data6'))"><i class="fa fa-edit"></i>&nbsp;Update</button>           
                                <button class="btn btn-danger btn-xs d-inline mb-2 mx-3" data-target="#ModalDelete" data-href="deleteobservation.php?id=<?php echo $r['obserID']; ?>" data-toggle="modal"><i class="fa fa-trash"></i>&nbsp;Delete</button>
                            </td>        
                        </tr>
                        <?php
                            }
                            ?>
                    </tbody>

                    <!-- The Modal -->
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
                    </div>

                    <!-- The Modal -->
                    <div id="myModal1" class="modal1">
                        <span class="close">&times;</span>
                        <img class="modal-content1" id="img01">
                        <div id="caption"></div>
                    </div>

                    <div class="modal fade" id="ModalDetailGambar" tabindex="-1" role="dialog" aria-labelledby="upload-avatar-title" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header box-solid bg-green">
                                    <h4 class="modal-title" id="memberModalLabel">Observation Locker</h4>
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                </div>
                                <div class="dash">
                                    <!-- Content goes in here -->
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
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

    function editDelete(x, a, b, c, d, e, f, g) {
        $('#ModalEdit').modal('show');
        $("#date_observation1").val(x);
        $('#description1').val(a);
        $('#locker_id1').val(b);
        $('#status_observation1').val(f).attr("selected", "selected");
        // $('#plant_observation1').val(c).attr("selected", "selected");
        // $('#floor_observation1').val(d).attr("selected", "selected");
        // $('#location_observation1').val(e);
        // $('#img1').val(f);
    }
</script>

<script>
    $('#ModalDetailGambar').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        var modal = $(this);
        var dataString = 'obserID=' + recipient;

        $.ajax({
            type: "GET",
            url: "showchart2.php",
            data: dataString,
            cache: false,
            success: function(data) {
                console.log(data);
                $('.dash').html(data);
            },
            error: function(err) {
                console.log(err);
            }
        });
    })
</script>










