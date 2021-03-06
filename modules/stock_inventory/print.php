<?php
session_start();
ob_start();


require_once "../../config/database.php";

include "../../config/fungsi_tanggal.php";

include "../../config/fungsi_rupiah.php";

$hari_ini = date("d-m-Y");

$no = 1;

$query = mysqli_query($mysqli, "SELECT codigo,nombre,precio_compra,precio_venta,unidad,stock,expire_date FROM medicamentos ORDER BY nombre ASC")
                                or die('Error '.mysqli_error($mysqli));
$count  = mysqli_num_rows($query);
?>
<html xmlns="http://www.w3.org/1999/xhtml"> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>INFORME DE STOCK DE MEDICAMENTOS</title>
        <link rel="stylesheet" type="text/css" href="../../assets/css/laporan.css" />
    </head>
    <body>
        <div id="title">
           STOCK DE MEDICAMENTOS
        </div>
        
        <hr><br>

        <div id="isi">
            <table width="100%" border="0.3" cellpadding="0" cellspacing="0">
                <thead style="background:#e8ecee">
                    <tr class="tr-title">
                        <th height="20" align="center" valign="middle"><small>No.</small></th>
                        <th height="20" align="center" valign="middle"><small>CODIGO</small></th>
                        <th height="20" align="center" valign="middle"><small>MEDICAMENTO</small></th>
                        <th height="20" align="center" valign="middle"><small>PRECIO DE COMPRA</small></th>
                        <th height="20" align="center" valign="middle"><small>PRECIO DE VENTA</small></th>
                        <th height="20" align="center" valign="middle"><small>STOCK</small></th>
                        <th height="20" align="center" valign="middle"><small>UNIDAD</small></th>
                        <th height="20" align="center" valign="middle"><small>FECHA VENCIMIENTO</small></th>
                    </tr>
                </thead>
                <tbody>
        <?php
       
        while ($data = mysqli_fetch_assoc($query)) {
            $precio_compra = format_rupiah($data['precio_compra']);
            $precio_venta = format_rupiah($data['precio_venta']);
          
            echo "  <tr>
                        <td width='30' class='center'>$no</td>
                      <td width='80' class='center'>$data[codigo]</td>
                      <td width='180'>$data[nombre]</td>
                      <td width='100' align='right'>Q $precio_compra</td>
                      <td width='100' align='right'>Q $precio_venta</td>
                      <td width='80' align='right'>$data[stock]</td>
                      <td width='80' class='center'>$data[unidad]</td>
                      <td width='80' class='center'>$data[expire_date]</td>
                    </tr>";
            $no++;
        }
        ?>  
                </tbody>
            </table>

            
        </div>
    </body>
</html>
<?php
$filename="INFORMDE STOCK.pdf"; 
//==========================================================================================================
$content = ob_get_clean();
$content = '<page style="font-family: freeserif">'.($content).'</page>';

require_once('../../assets/plugins/html2pdf_v4.03/html2pdf.class.php');
try
{
    $html2pdf = new HTML2PDF('P','F4','en', false, 'ISO-8859-15',array(10, 10, 10, 10));
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output($filename);
}
catch(HTML2PDF_exception $e) { echo $e; }
?>