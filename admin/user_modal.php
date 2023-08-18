<?php
include("../../theme/config.php");
$id = $_GET['id_user'];
$qr = sqlsrv_query($conn, "SELECT * FROM mst_users WHERE id_user = '$id'");

while ($data = sqlsrv_fetch_array($qr)) {
    ?>
    <div class="box-body">
        <div class="form-group col-sm-12">
            <label class="control-label col-sm-2" for="name_user">Name</label>
            <div class="col-sm-10">
                <input type="hidden" name="id" value="<?php echo $data['id_user']; ?>">
                <input type="text" name="name_user" maxlength="100" class="form-control" value="<?php echo $data['name']; ?>" disabled>
            </div>
        </div>

        <div class="form-group col-sm-12">
            <label class="control-label col-sm-2" for="username_user">Username</label>
            <div class="col-sm-10">
                <input type="text" name="username_user" maxlength="200" class="form-control" value="<?php echo $data['sesa_id']; ?>" disabled>
            </div>
        </div>

        <div class="form-group col-sm-12">
            <label class="control-label col-sm-2" for="old_pass">Old Password</label>
            <div class="col-sm-10">
                <input type="text" name="old_pass" maxlength="100" class="form-control" required>
            </div>
        </div>

        <div class="form-group col-sm-12">
            <label class="control-label col-sm-2" for="new_pass">New Password</label>
            <div class="col-sm-10">
                <input type="text" name="new_pass" maxlength="100" class="form-control" required>
            </div>
        </div>

        <div class="form-group col-sm-12">
            <label class="control-label col-sm-2" for="confirm_pass">Confirm Password</label>
            <div class="col-sm-10">
                <input type="text" name="confirm_pass" maxlength="100" class="form-control" required>
            </div>
        </div>

    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <div class="form-group col-sm-12">
            <label class="control-label col-sm-2"></label>
            <div class="col-sm-10">
                <button name="btn_change" class="btn btn-sm btn-lg btn-success"><i class="fa fa-save"></i> Save</button>
                <button type="button" class="btn btn-sm btn-lg btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
            </div>
        </div>
    </div>
<?php
}
?>
<script>
    $("button[name=btn_change]").on("click", function() {
        var id = $("input[name=id]").val();
        var old_pass = $("input[name=old_pass]").val();
        var new_pass = $("input[name=new_pass]").val();
        var confirm_pass = $("input[name=confirm_pass]").val();
        $.ajax({
            type: "POST",
            url: "changepassword.php",
            data: {
                id: id,
                old_pass: old_pass,
                new_pass: new_pass,
                confirm_pass: confirm_pass
            },
        }).done(function(msg) {
            if (msg == "success") {
                alert("Password Has Been Change");
                location.reload();
            } else if (msg == "old_pass") {
                alert("Old Password not Match");
            } else {
                alert("New Password not Match");
            }

        })
    })
</script>