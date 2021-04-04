<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>患者管理列表</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <link rel="shortcut icon" href="favicon.ico"> <link href="../css/bootstrap.min.css?v=3.3.5" rel="stylesheet">
    <link href="../css/font-awesome.min.css?v=4.4.0" rel="stylesheet">

    <!-- Data Tables -->
    <link href="../css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">

    <link href="../css/animate.min.css" rel="stylesheet">
    <link href="../css/style.min.css?v=4.0.0" rel="stylesheet"><base target="_blank">

</head>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>基本 <small>分类，查找</small></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="table_data_tables.html#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="table_data_tables.html#">选项1</a>
                            </li>
                            <li><a href="table_data_tables.html#">选项2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="">
                        <a onclick="fnClickAddRow();" class="btn btn-primary ">添加患者</a>
                    </div>
                    <table id="tab" class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                        <tr>
                            <th>就诊号</th>
                            <th>发病时间</th>
                            <th>就诊时间</th>
                            <th>地址</th>
                            <th>姓名</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $conn = new mysqli('localhost', 'root', 'root', 'test');
                            if ($conn->connect_error) {
                                die("连接失败: " . $conn->connect_error);
                            }
                            $sql = 'SELECT * FROM patient';
                            $result = $conn->query($sql);
                            // 把结果集转换成数组赋值给$row,如果有数据为真
                            while(!!$row = mysqli_fetch_array($result)){
                                echo "<tr>";
                                echo "<td id='patient_no'>$row[patient_no]</td>"; //联系人
                                echo "<td><input type='hidden' value='$row[onset_time]'>".$row["onset_time"]." </input></td>";
                                echo "<td><input type='hidden' name='treatment_time' value='$row[treatment_time]'>".$row["treatment_time"]."</input> </td>";
                                echo "<td><input type='hidden' name='address' value='$row[address]'>".$row["address"]." </input></td>";
                                echo "<td><input type='hidden' name='name' value='$row[name]'>".$row["name"]."</input> </td>";
                                echo "<td><button type='button' class='btn btn-primary btn-sm' name='no'><a onclick='edit(".$row["patient_no"].")'>修改</a></button>
                                        <button type='button' class='btn btn-primary btn-sm'><a onclick='del(".$row["patient_no"].")'>删除</a></button>
                                </td>";
                                echo "</tr>";
                            }
                            mysqli_close($conn);
                        ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="../js/jquery.min.js?v=2.1.4"></script>
<script src="../js/bootstrap.min.js?v=3.3.5"></script>
<script src="../js/plugins/jeditable/jquery.jeditable.js"></script>
<script src="../js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="../js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="../js/content.min.js?v=1.0.0"></script>
<script>
    $(document).ready(function(){
        $(".dataTables-example").dataTable();
        var oTable=$("#editable").dataTable();
        oTable.$("td").editable("../example_ajax.php",{
            "callback":function(sValue,y) {
            var aPos=oTable.fnGetPosition(this);
            oTable.fnUpdate(sValue,aPos[0],aPos[1])},
            "submitdata":function(value,settings){
            return{"row_id":this.parentNode.getAttribute("id"),"column":oTable.fnGetPosition(this)[2]}},"width":"90%","height":"100%"})}
    );
    function fnClickAddRow(){
        $(window).attr('location','addPatient.html');
    };
    function edit(res){
        $(window).attr('location','editPatient.php?pno=' + res);
    };
    function del(res){
        $.ajax({
            url: 'deletePatient.php',
            type: 'POST',
            data: {no: res},
            success: function(){
                location.reload();
            }
    })
    };
</script>
<script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>

</body>

</html>