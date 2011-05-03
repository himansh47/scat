<?
require 'scat.php';

head("transaction");

$id= (int)$_REQUEST['id'];

$type= $_REQUEST['type'];
$number= (int)$_REQUEST['number'];
if (!$id && $type) {
  $r= $db->query("SELECT id FROM txn WHERE type = '". $db->real_escape_string($type) ."' AND number = $number");

  if (!$r->num_rows)
      die("<h2>No such transaction found.</h2>");

  $row= $r->fetch_row();
  $id= $row[0];
}

if (!$id) die("no transaction specified.");

switch ($type) {
case 'vendor';
?>
<script>
$.expr[":"].match = function(obj, index, meta, stack){
  return (obj.textContent || obj.innerText || $(obj).text() || "") == meta[3];
}
$(function() {
  $('#receive #search').focus()
  $('#receive .submit').click(function() {
    $('#receive .error').hide(); // hide old error messages
    var q = $("#receive #search").val();
    $.ajax({
      url: "txn-item-receive.php",
      dataType: "json",
      data: ({ type: "<?=$type?>", number: "<?=$number?>", search: q }),
      success: function(data) {
        if (data.error) {
          $("#receive .error").html("<p>" + data.error + "</p>");
          $("#receive .error").show();
        } else {
          // update table
          var row= $(".sortable td.num:match(" + data.line + ")").parent()
          $(row).children(":eq(6)").text(data.ordered)
          $(row).children(":eq(7)").text(data.shipped)
          $(row).children(":eq(8)").text(data.allocated)
          $("#receive #search").val("");
        }
      }
    });
    return false;
  });
});
</script>
<form id="receive" action="txn-item-receive.php" method="post">
 <div class="error" style="display: none"></div>
 <input id="type" type="hidden" name="type" value="<?=ashtml($type)?>">
 <input id="number" type="hidden" name="number" value="<?=ashtml($number)?>">
 <input id="search" type="text" name="search">
 <input class="submit" type="submit" name="Receive">
</form>
<?
  break;
}


$type= $db->real_escape_string($type);

$q= "SELECT
            line AS `#\$num`,
            item.code Code\$item,
            item.name Name,
            txn_line.retail_price MSRP\$dollar,
            IF(txn_line.discount_type,
               CASE txn_line.discount_type
                 WHEN 'percentage' THEN ROUND(txn_line.retail_price * ((100 - txn_line.discount) / 100), 2)
                 WHEN 'relative' THEN (txn_line.retail_price - txn_line.discount) 
                 WHEN 'fixed' THEN (txn_line.discount)
               END,
               NULL) Sale\$dollar,
            CASE txn_line.discount_type
              WHEN 'percentage' THEN CONCAT(ROUND(txn_line.discount), '% off')
              WHEN 'relative' THEN CONCAT('$', txn_line.discount, ' off')
            END Discount,
            ordered as Ordered,
            shipped as Shipped,
            allocated as Allocated
       FROM txn
       LEFT JOIN txn_line ON (txn.id = txn_line.txn)
       JOIN item ON (txn_line.item = item.id)
      WHERE txn.id = $id
      ORDER BY line ASC";

dump_table($db->query($q));
dump_query($q);

if ($type == 'customer') {
  echo '<h2>Payments</h2>';
  $q= "SELECT processed AS Date,
              method AS Method,
              amount AS Amount\$dollar
         FROM payment
        WHERE txn = $id
        ORDER BY processed ASC";
  dump_table($db->query($q));
  dump_query($q);
}

switch ($type) {
case 'vendor';
?>
<form enctype="multipart/form-data" action="txn-load-mac.php" method="post">
 <input type="hidden" name="type" value="<?=ashtml($type)?>">
 <input type="hidden" name="number" value="<?=ashtml($number)?>">
 <input type="file" name="src">
 <br>
 <input type="submit" name="Import from MacPhersons">
</form>
<?
  break;
}

