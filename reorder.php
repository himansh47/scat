<?
include 'scat.php';

head("reorder");
?>
<style>
.order { text-align: right; }
</style>
<button id="download">Download</button>
<?

$q= "SELECT code Code\$item,
            name Name,
            SUM(allocated) Stock\$right,
            minimum_quantity Min\$right,
            (SELECT -1 * SUM(allocated)
               FROM txn_line JOIN txn ON (txn = txn.id)
              WHERE type = 'customer'
                AND item = item.id AND filled > NOW() - INTERVAL 3 MONTH)
            AS Last3Months\$right,
            minimum_quantity AS Order\$order
       FROM item
       LEFT JOIN txn_line ON (item = item.id)
      WHERE active AND NOT deleted AND code NOT LIKE 'ZZ%'
      GROUP BY item.id
     HAVING NOT Stock\$right OR Stock\$right < Min\$right
      ORDER BY code
      ";

dump_table($db->query($q));
dump_query($q);
?>
<form id="post-csv" style="display: none"
      method="post" action="api/encode-tsv.php">
<textarea id="file" name="file"></textarea>
</form>
<script>
$('.order').editable(function (val, settings) { return val; });

$('#download').on('click', function(ev) {
  var tsv= "code\tqty\r\n";
  $.each($(".sortable tr"), function (i, row) {
    if (i > 0 && parseInt($('.order', row).text()) > 0) {
      tsv += $('.item a', row).text() + "\t" + $('.order', row).text() + "\r\n";
    }
  });
  $("#file").val(tsv);
  $("#post-csv").submit();
});
</script>
<?

foot();