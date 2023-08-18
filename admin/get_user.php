<?php
include("../../theme/config.php");

    $id = $_POST['id'];
    // var_dump($id);
    $sql = sqlsrv_query($conn, "SELECT * FROM tb_user_locker WHERE id_user = $id");
    // if ($sql) {
        $data = sqlsrv_fetch_array($sql);

?>

<div class="box-body">
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="name_user">Name</label>
            <div class="col-sm-8">
                <input type="hidden" id="id" name="id" value="<?php echo $data['id_user']; ?>">
                <input type="text" id="name_user" name="name_user" maxlength="100" class="form-control" value="<?php echo $data['name']; ?>" disabled>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="username_user">Username</label>
            <div class="col-sm-8">
                <input type="text" id="username_user" name="username_user" maxlength="200" class="form-control" value="<?php echo $data['username']; ?>" disabled>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="new_pass">New Password</label>
            <div class="col-sm-8">
                <input type="password" id="new_pass" name="new_pass" maxlength="100" class="form-control" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="confirm_pass">Confirm Password</label>
            <div class="col-sm-8">
                <input type="password" name="confirm_pass" id="confirm_pass" maxlength="100" class="form-control" required>
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
</div>

<script>
    $("button[name=btn_change]").on("click", function() {
    

        var id = $('#id').val();
        //var old_pass = $('#old_pass').val();
        var new_pass = $('#new_pass').val();
        var confirm_pass = $('#confirm_pass').val();

        $.ajax({
            type: "POST",
            url: "changepassword.php",
            data: {
                id: id,
                //old_pass: old_pass,
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
