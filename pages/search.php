<!DOCTYPE html>
<html lang="en">
<?php
	include "db_connect.php";
?>
<?php
    $totalline = $_POST['ct'];
    $sql_stmt = "select distinct year, paper_title from paper where ";
    $flag_data = "";
    
    $logic_sym = "";
    $name_field = "";
    $input_field = "";
    for($i = 0; $i < $totalline; $i++){
        if($i !== 0){
            $logic_sym = " ".strtolower($_POST["logic_sym".$i])." ";
        }

        $name_field =  $_POST["name_field".$i];
        $input_field = $_POST["inputfield".$i];

        if($input_field !== ""){
            if($i !== 0){
                $sql_stmt = $sql_stmt.$logic_sym." ";
            }
            $sql_stmt = $sql_stmt."(" ;
            
            if(strpos($name_field, 'author') !== false){
                $sql_stmt = $sql_stmt."p_id in (select distinct p_id from paper_author where paper_author.a_id in (select distinct a.a_id from author as a where a.a_name like \"%";
                $sql_stmt = $sql_stmt.$input_field."%\"))";
            }
            if(strpos($name_field, 'journal name') !== false){
                $sql_stmt .= "j_id in (select j_id from journal where j_name like \"%";
                $sql_stmt .= $input_field."%\"";
                $sql_stmt .= ")";
            }
            
            if(strpos($name_field, 'year') !== false){
                $sql_stmt .= "year like \"%";
                $sql_stmt .= $input_field."%\"";
            }
            
            if(strpos($name_field, 'title') !== false){
                $sql_stmt .= "paper_title like \"%";
                $sql_stmt .= $input_field."%\"";
            }
            $sql_stmt = $sql_stmt.")";
        }
    }
    echo $sql_stmt.";";
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>scimap</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head>

<body>
    <script>
        var counter = 1;
        function addfield(divName){
            var newdiv = document.createElement('div');
            newdiv.innerHTML = " \
            <select name=\"logic_sym" + counter + "\"> \
                <option value=\"AND\">AND</option> \
                <option value=\"NOT\">NOT</option> \
                <option value=\"OR\">OR</option> \
            </select> \
            <select name=\"name_field" + counter + "\"> \
                <option value=\"journal name\">journal name</option> \
                <option value=\"paper year\">paper year</option> \
                <option value=\"paper title\">paper title</option> \
                <option value=\"author name\">author name</option> \
            </select> \
            ";
            newdiv.innerHTML += "<input type=\"text\" name=\"inputfield" + counter + "\">";
            document.getElementById(divName).appendChild(newdiv);
            counter++;
            newdiv.innerHTML += "<input type=\"hidden\" name=\"ct\" value=\"" + counter + "\">";
        };
    </script>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">scimap</a>
            </div>
            <!-- /.navbar-header -->



            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="index.html"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>

                        <li>
                            <a href="search.php"><i class="fa fa-table fa-fw"></i> Search</a>
                        </li>
                        <li>
                            <a href="forms.html"><i class="fa fa-edit fa-fw"></i> Forms</a>
                        </li>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Result</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            DataTables Advanced Tables
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <form method="POST">
                                    <div id="multiinput">
                                        <select name="name_field0">
                                            <option value="journal name">journal name</option> 
                                            <option value="paper year">paper year</option> 
                                            <option value="paper title">paper title</option> 
                                            <option value="author name">author name</option> 
                                        </select>
                                        <input type="text" name="inputfield0">
                                        <input type="button" value="Add field" onClick="addfield('multiinput')" />
                                        <input type="submit">
                                    </div>
                                </form>

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    
                                    <thead>
                                        <tr>
                                            <td>paper title</td>
                                            <td>paper year</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        include "db_connect.php";
                                        $event = $conn -> query($sql_stmt);
                                        if($event -> num_rows > 0){
                                            while($row = $event -> fetch_assoc()){
                                                echo "<tr><th>";
                                                echo $row["paper_title"];
                                                echo "</th>";
                                                echo "<th>";
                                                echo $row["year"];
                                                echo "</th></tr>";
                                            }
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
            
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example tfoot th').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        } );

        var table = $('#dataTables-example').DataTable();

        // Apply the search
        table.columns().every( function () {
            var that = this;
     
            $( 'input', this.footer() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        } );
    });
    </script>

</body>

</html>
