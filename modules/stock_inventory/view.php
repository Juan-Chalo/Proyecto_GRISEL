

<section class="content-header">
  <h1>
    <i class="fa fa-file-text-o icon-title"></i> Stock de Medicamentos

    <a class="btn btn-primary btn-social pull-right" href="modules/stock_inventory/print.php" target="_blank">
      <i class="fa fa-print"></i> Imprimir
    </a>
  </h1>

</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-body">
    
          <table id="dataTables1" class="table table-bordered table-striped table-hover">
      
            <thead>
              <tr>
                <th class="center">No.</th>
                <th class="center">Codigo</th>
                <th class="center">Nombre</th>
                <th class="center">Precio de compra</th>
                <th class="center">Precio de venta</th>
                <th class="center">Stock</th>
                <th class="center">Unidad</th>
                <th class="center">Fecha Vencimiento</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            <?php  
            $no = 1;
            $query = mysqli_query($mysqli, "SELECT codigo,nombre,precio_compra,precio_venta,unidad,stock,expire_date FROM medicamentos ORDER BY codigo DESC")
                                            or die('error: '.mysqli_error($mysqli));

            while ($data = mysqli_fetch_assoc($query)) { 
              $precio_compra = format_rupiah($data['precio_compra']);
              $precio_venta = format_rupiah($data['precio_venta']);
           
              echo "<tr>
                      <td width='30' class='center'>$no</td>
                      <td width='80' class='center'>$data[codigo]</td>
                      <td width='180'>$data[nombre]</td>
                      <td width='100' align='right'>Q $precio_compra</td>
                      <td width='100' align='right'>Q $precio_venta</td>
                      <td width='80' align='right'>$data[stock]</td>
                      <td width='80' class='center'>$data[unidad]</td>
                      <td width='80' class='center'>$data[expire_date]</td>
                      <td class='center' width='80'>
                        <div>
                          <a data-toggle='tooltip' data-placement='top' title='modificar' style='margin-right:5px' class='btn btn-primary btn-sm' href='?module=form_medicines&form=edit&id=$data[codigo]'>
                              <i style='color:#fff' class='glyphicon glyphicon-edit'></i>
                          </a>";
            ?>
                          <a data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-danger btn-sm" href="modules/medicines/proses.php?act=delete&id=<?php echo $data['codigo'];?>" onclick="return confirm('estas seguro de eliminar<?php echo $data['nombre']; ?> ?');">
                              <i style="color:#fff" class="glyphicon glyphicon-trash"></i>
                          </a>
            <?php
              echo "    </div>
                      </td>
                    </tr>";
              $no++;
            }
            ?>
            </tbody>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col -->
  </div>   <!-- /.row -->
</section><!-- /.content