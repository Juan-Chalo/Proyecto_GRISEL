  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-home icon-title"></i> Inicio
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=beranda"><i class="fa fa-home"></i> Inicio</a></li>
    </ol>
  </section>
  
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-lg-12 col-xs-12">
        <div class="alert alert-info alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <p style="font-size:15px">
            <i class="icon fa fa-user"></i> Bienvenido <strong><?php echo $_SESSION['name_user']; ?></strong> Al Sitio Oficial del Hospital Regional de Cuilapa Santa Rosa - "Licenciado Guillermo Fernandez Llerena" .
          </p>        
        </div>
      </div>  
    </div>
   
    <!-- Small boxes (Stat box) -->
    <div class="row">

      





      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div style="background-color:#00a65a;color:#fff" class="small-box">
          <div class="inner">
            <?php   
   
            $query = mysqli_query($mysqli, "SELECT COUNT(codigo_transaccion) as numero FROM transaccion_medicamentos")
                                            or die('Error '.mysqli_error($mysqli));


            $data = mysqli_fetch_assoc($query);
            ?>
            
            <h3><?php echo $data['numero']; ?></h3>
            <p>Total de Entradas/Salidas de Medicamentos</p>
          </div>
          <div class="icon">
            <i class="fa fa-sign-in"></i>
          </div>
          <?php  
          if ($_SESSION['permisos_acceso']!='gerente') { ?>
            <!--<a href="?module=form_medicines_transaction&form=add" class="small-box-footer" title="Agregar" data-toggle="tooltip"><i class="fa fa-plus"></i></a>-->
          <?php
          } else { ?>
            <a class="small-box-footer"><i class="fa"></i></a>
          <?php
          }
          ?>
        </div>
      </div><!-- ./col -->







      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div style="background-color:#f39c12;color:#fff" class="small-box">
          <div class="inner">
            <?php  
  
            $query = mysqli_query($mysqli, "SELECT COUNT(codigo) as numero FROM medicamentos")
                                            or die('Error'.mysqli_error($mysqli));

            $data = mysqli_fetch_assoc($query);
            ?>
            <!--<h3></h3>-->
            <h3><?php echo $data['numero']; ?></h3>
            <p>Stock Medicamentos</p>
          </div>
          <div class="icon">
            <i class="fa fa-file-text-o"></i>
          </div>
          <!--<a href="?module=stock_inventory" class="small-box-footer" title="Imprimir" data-toggle="tooltip"><i class="fa fa-print"></i></a>-->
        </div>
      </div><!-- ./col -->







      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div style="background-color:#dd4b39;color:#fff" class="small-box">
          <div class="inner">
            <?php   
  
            $query = mysqli_query($mysqli, "SELECT COUNT(id_user) as numero FROM usuarios")
                                            or die('Error: '.mysqli_error($mysqli));

            $data = mysqli_fetch_assoc($query);
            ?>
            <!--<h3></h3>-->
            <h3><?php echo $data['numero']; ?></h3>
            <p>Total de Usuarios</p>
          </div>
          <div class="icon">
            <i class="fa fa-clone"></i>
          </div>
          <!--<a href="?module=stock_report" class="small-box-footer" title="Imprimir" data-toggle="tooltip"><i class="fa fa-print"></i></a>-->
        </div>
      </div><!-- ./col -->



      <div class="row">
    <div class="col-md-12">
      <section class="content-header">
  <h1>
    <i class="fa fa-folder-o icon-title"></i> Listado Productos prontos a Expirar en 10 dias.

  </h1>

</section>

    <?php  

    if (empty($_GET['alert'])) {
      echo "";
    } 
  
    elseif ($_GET['alert'] == 1) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Exito!</h4>
             Nuevos datos de medicamentos ha sido  almacenado correctamente.
            </div>";
    }

    elseif ($_GET['alert'] == 2) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Exito!</h4>
             Datos del Medicamento modificados correcamente.
            </div>";
    }

    elseif ($_GET['alert'] == 3) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Exito!</h4>
            Se eliminaron los datos del Medicamento
            </div>";
    }
    ?>

      <div class="box box-primary">
        <div class="box-body">
    
          <table id="dataTables1" class="table table-bordered table-striped table-hover">
      
            <thead>
              <tr>
                <th class="center">No.</th>
                <th class="center">Codigo del Producto</th>
                <th class="center">Nombre del producto</th>
                <th class="center">Fecha Expiracion</th>

              </tr>
            </thead>
            <tbody>
            <?php  
            $no = 1;
            $query = mysqli_query($mysqli, "SELECT codigo, nombre, expire_date FROM `medicamentos` WHERE expire_date BETWEEN CURRENT_DATE() and CURRENT_DATE + INTERVAL 11 DAY")
                                            or die('error: '.mysqli_error($mysqli));

            while ($data = mysqli_fetch_assoc($query)) { 
           
              echo "<tr>
                      <td width='30' class='center'>$no</td>
                      <td width='80' class='center'>$data[codigo]</td>
                      <td width='180' class='center'>$data[nombre]</td>
                      <td width='80' align='right'>$data[expire_date]</td>
                    </tr>";
            }
            ?>
            </tbody>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col -->
  </div>   <!-- /.row -->




    </div><!-- /.row -->
  </section><!-- /.content -->