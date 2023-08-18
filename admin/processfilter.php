<?php
  session_start();
  include("../../theme/config.php");

  $plant=$_POST['plant'];
  $plant = str_replace(' ','', $plant);
  $shift_floor = $_POST['shift_floor'];
  $shift= $_POST['shift'];
  $shift_type = $_POST['shift_type'];
  $inspecting= $_POST['inspecting'];
  $location = $_POST['location'];
  $nomor= 0;
  $id_no2 = 0;
  $time_now = date('Y-m-d');
?>

<table class="table table-bordered table-white" id="tablelist">
  <thead hidden>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
  </thead>
  <tbody>
    <?php
      $sql = "SELECT  a.*,b.status, b.list_upload, c.insp_head_id FROM mst_inspection a,tbl_insp_detail b, tbl_insp_header c WHERE a.insp_id=b.insp_id AND c.insp_head_id = b.insp_head_id AND c.insp_date = CAST('$time_now' as date) AND c.plant='$plant' AND c.shift = '$shift' AND c.floor = '$shift_floor' AND c.location = '$location' AND c.typeofcheck = '$shift_type'";
      // echo $sql;
      $sqlquery = sqlsrv_query($conn, $sql, array(), array( "Scrollable" => 'static' ));
      $row_count = sqlsrv_num_rows($sqlquery);
      if($row_count > 0){
        while ($res = sqlsrv_fetch_array($sqlquery)) {
          $id_no2 = $res['insp_head_id'];
          $idno = $id_no2;
          $nomor++;
        ?>
    <tr>
      <td> <?=$nomor?> </td>
      <td cols="10"> <?= $res['insp_list_eng'] ?><br> <span class="bahasa"> (<?= $res['insp_list_idn'] ?>)</span> </td>
      <td>
        <div class="input-group">
          <div id="radioBtn" class="btn-group">
            <input type="hidden" name="id_no2" id="id_no2" value="<?= $res['insp_head_id']; ?>">
            <a class="btn btn-success btn-sm <?php if($res['status'] == 'Oke') { echo "active"; }else{ echo "notActive"; } ?>"
              id_insp="<?= $res['insp_id']?>" status_insp="Oke" data-title="Y" head_id="<?= $res['insp_head_id']; ?>"
              onclick="setstatus( $(this).attr('head_id'),$(this).attr('id_insp'),$(this).attr('status_insp'))">OKE</a>
            <a class="btn btn-danger btn-sm <?php if($res['status'] == 'Not Oke') { echo "active"; }else{ echo "notActive"; } ?>"
              id_insp="<?= $res['insp_id']?>" status_insp="Not Oke" data-title="Y"
              head_id="<?= $res['insp_head_id']; ?>"
              onclick="setstatus( $(this).attr('head_id'),$(this).attr('id_insp'),$(this).attr('status_insp'))">NOT
              OKE</a>
          </div>
          <input type="hidden" name="happy" id="happy">
        </div>
      </td>
      <td> <button type="button" class="btn btn-info" pict_ref="<?= $res['pict_ref'] ?>" id="pict_ref"
          onclick="reference ($(this).attr('pict_ref'))"> Pictures Reference </button>


      <td>
        <div class="col-md-1" name="upload_button " id="upload_button">
          <label>
            <input id="upl_file<?= $res['insp_id'] ?>" name="upl_file<?= $res['insp_id'] ?>"
              onchange="getNameFile('<?= $res['insp_id'] ?>', '<?php echo $idno ?>')" type="file" accept="image/*">
            <span class="btn btn-info btn-xs"><i class="fas fa-paperclip"> Upload Picture </i></span></br>
            <span class="text-black"
              id="nameFile<?= $res['insp_id'] ?>"><?php if($res['list_upload'] != ""){echo $res['list_upload'];} ?></span>
          </label>
        </div>
      </td>

      <td>
        <textarea class="form-control input-add largertext" id="desk<?= $res['insp_id'] ?>"
          onfocusout="postDesk('<?= $res['insp_id'] ?>','<?= $idno ?>')" cols="20" rows="4" oninput="validate()"
          placeholder="Description"></textarea>
      </td>


    </tr>
    <?php
        }
      }else{
        $getMaxId = sqlsrv_query($conn, "SELECT max(insp_head_id) as insp_head_id from tbl_insp_header");
        $res = sqlsrv_fetch_array($getMaxId);
        $new_insp_head_id=$res['insp_head_id']+1;
       
        $sqlInsert = sqlsrv_query($conn, "INSERT INTO tbl_insp_header(insp_head_id, insp_date,shift,location,floor,plant,typeofcheck) VALUES($new_insp_head_id, '$time_now', '$shift', '$location', '$shift_floor', '$plant', '$shift_type')
        INSERT INTO tbl_insp_detail (insp_head_id, insp_id, status)  SELECT $new_insp_head_id, insp_id, NULL FROM mst_inspection");

        $sqlquery = sqlsrv_query($conn, "SELECT  a.*,b.status,b.list_upload,c.insp_head_id FROM mst_inspection a,tbl_insp_detail b, tbl_insp_header c WHERE a.insp_id=b.insp_id AND c.insp_head_id = b.insp_head_id AND c.insp_date = CAST('$time_now' as date) AND c.plant='$plant' AND c.shift = '$shift' AND c.floor = '$shift_floor' AND c.location = '$location' AND c.typeofcheck = '$shift_type'");
        while ($res = sqlsrv_fetch_array($sqlquery)) {
          $id_no2 = $res['insp_head_id'];
          $nomor++;
          ?>
    <tr>
      <td> <?=$nomor?> </td>
      <td cols="10"> <?= $res['insp_list_eng'] ?><br> <span class="bahasa"> (<?= $res['insp_list_idn'] ?>)</span> </td>
      <td>
        <div class="input-group">
          <div id="radioBtn" class="btn-group">
            <input type="hidden" name="id_no2" id="id_no2" value="<?= $res['insp_head_id']; ?>">
            <a class="btn btn-success btn-sm <?php if($res['status'] == 'Oke') { echo "active"; }else{ echo "notActive"; } ?>"
              id_insp="<?= $res['insp_id']?>" status_insp="Oke" data-title="Y" head_id="<?= $res['insp_head_id']; ?>"
              onclick="setstatus( $(this).attr('head_id'),$(this).attr('id_insp'),$(this).attr('status_insp'))">OKE</a>
            <a class="btn btn-danger btn-sm <?php if($res['status'] == 'Not Oke') { echo "active"; }else{ echo "notActive"; } ?>"
              id_insp="<?= $res['insp_id']?>" status_insp="Not Oke" data-title="Y"
              head_id="<?= $res['insp_head_id']; ?>"
              onclick="setstatus( $(this).attr('head_id'),$(this).attr('id_insp'),$(this).attr('status_insp'))">NOT
              OKE</a>
          </div>
          <input type="hidden" name="happy" id="happy">
        </div>
      </td>
      <td> <button type="button" class="btn btn-info btn-xs" pict_ref="<?= $res['pict_ref'] ?>" id="pict_ref"
          onclick="reference ($(this).attr('pict_ref'))"> Pictures Reference </button>


      <td>
        <div class="col-md-1" name="upload_button " id="upload_button">
          <label>
            <input id="upl_file<?= $res['insp_id'] ?>" name="upl_file<?= $res['insp_id'] ?>" type="file"
              onchange="getNameFile('<?= $res['insp_id'] ?>', '<?php echo $idno ?>')" accept="image/*">
            <span class="btn btn-info"><i class="fas fa-paperclip"> Upload Picture </i></span></br>
            <span class="text-black"
              id="nameFile<?= $res['insp_id'] ?>"><?php if($res['list_upload'] != ""){echo $res['list_upload'];} ?></span>
          </label>
        </div>
      </td>
      <td>
        <textarea class="form-control input-add largertext" id="desk<?= $res['insp_id'] ?>"
          onfocusout="postDesk('<?= $res['insp_id'] ?>','<?= $idno ?>')" cols="20" rows="4" oninput="validate()"
          placeholder="Description"></textarea>
      </td>


    </tr>
    <?php
        }
      }
    ?>
  </tbody>
</table>
|||<?= $id_no2; ?>