
<!DOCTYPE html>
<html lang="zh">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>患者修改</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <link rel="shortcut icon" href="favicon.ico"> <link href="../css/bootstrap.min.css?v=3.3.5" rel="stylesheet">
    <link href="../css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="../css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="../css/animate.min.css" rel="stylesheet">
    <link href="../css/style.min.css?v=4.0.0" rel="stylesheet"><base target="_blank">
    <link href="../css/plugins/chosen/chosen.css" rel="stylesheet">
    <link href="../css/plugins/colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="../css/plugins/cropper/cropper.min.css" rel="stylesheet">
    <link href="../css/plugins/switchery/switchery.css" rel="stylesheet">
    <link href="../css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
    <link href="../css/plugins/nouslider/jquery.nouislider.css" rel="stylesheet">
    <link href="../css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="../css/plugins/ionRangeSlider/ion.rangeSlider.css" rel="stylesheet">
    <link href="../css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css" rel="stylesheet">
    <link href="../css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <link href="../css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
    <link href="../css/animate.min.css" rel="stylesheet">
</head>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>患者添加 <small>患者信息</small></h5>
                </div>
                <?php
                    $no = $_GET['pno'];
                    // 创建连接
                    $conn = new mysqli('localhost', 'root', 'root', 'test');
                    // Check connection
                    if ($conn->connect_error) {
                        die("连接失败: " . $conn->connect_error);
                    }
                    $sql = "SELECT * FROM patient where patient_no = $no";
                    $result = $conn->query($sql);
                    if ($result) {
                        // 输出数据
                        while($row = mysqli_fetch_array($result)) {
                            echo '<form class="form-horizontal" id="add_value">
                                <div class="form-group">
                                <label class="col-sm-2 control-label">患者门诊号</label>
                                <div class="col-sm-10">';
                            echo   '<input type="text" name="patient_no" id="patient_no" value="'.$row["patient_no"].'" class="form-control"></input>';
                            echo    '</div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">患者姓名</label>
                                    <div class="col-sm-10">';
                                    echo    '<input type="text" name="patient_name" id="patient_name" value="'.$row["name"].'" class="form-control"></input>';
                                    echo        '</div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group" id="data_1">
                                    <label class="col-sm-2 control-label">发病时间</label>
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>';
                                echo  '<input type="text" class="form-control" name="onset_time" id="onset_time" value="'.$row["onset_time"].'">';
                                echo '</div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group" id="data_2">
                                    <label class="col-sm-2 control-label">就诊时间</label>
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>';
                                echo    '<input type="text" class="form-control" name="treatment_time" id="treatment_time" value="'.$row["treatment_time"].'">';
                                echo    '</div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">诊前使用抗生素</label>
                                    <div class="col-sm-10">
                                        <select class="form-control m-b" name="antibiotic">';
                                        if ($row["antibiotic"] == 1){
                                            echo '<option value="1">是</option>
                                            <option value="0">否</option>';
                                        }else{
                                            echo '
                                                <option value="0">否</option>                                                                
                                                <option value="1">是</option>
                                            ';
                                        }
                                        echo '
                                        </select>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">是否住院</label>
                                    <div class="col-sm-10">
                                        <select class="form-control m-b" name="hospitalized">';
                                        if ($row["hospitalized"] == "是" ){
                                            echo '<option value="是">是</option>
                                            <option value="否">否</option>';
                                        }else{
                                            echo '<option value="否">否</option>
                                            <option value="是">是</option>';
                                        }
                                        echo  '</select>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">性别</label>
                                    <div class="col-sm-10">
                                        <select class="form-control m-b" name="gender">';
                                        if ($row == "男" ){
                                            echo '<option value="男">男</option>
                                                        <option value="女">女</option>';
                                        }else{
                                            echo '<option value="女">女</option>
                                                        <option value="男">男</option>';
                                        }
                                    echo    '</select>
                                        </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">身份证号</label>
                                            <div class="col-sm-10">';
                                    echo    '<input type="text" class="form-control" name="id_card" value="'.$row["id_card"].'">';
                                    echo '</div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">联系电话</label>
                                            <div class="col-sm-10">';
                                            echo    '<input type="text" class="form-control" name="phone" value="'.$row["phone"].'">';
                                    echo '</div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">省市区</label>
                                            <div class="col-sm-10">';
                                    echo  '<input type="text" class="form-control" name="province">';
                                    echo    '</div>
                                             </div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">详细地址</label>
                                                <div class="col-sm-10">';
                                    echo  '<input type="text" class="form-control" name="address" value="'.$row["address"].'">';
                                    echo    '</div>
                                            </div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">接诊医生</label>
                                                <div class="col-sm-10">';
                                    echo    '<input type="text" class="form-control" name="doctor" value="'.$row["doctor"].'">';
                                    echo    '</div>
                                            </div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">初步诊断</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control m-b" name="diagnosis">';
                                    echo '<option value="'.$row["diagnosis"].'">'.$row["diagnosis"].'</option>';
                                    echo '              <option value="急性肠胃炎">急性肠胃炎</option>
                                                        <option value="感染性腹泻">感染性腹泻</option>
                                                        <option value="毒蘑菇中毒">毒蘑菇中毒</option>
                                                        <option value="河豚中毒">河豚中毒</option>
                                                        <option value="菜豆中毒">菜豆中毒</option>
                                                        <option value="肉毒中毒">肉毒中毒</option>
                                                        <option value="亚硝酸盐中毒">亚硝酸盐中毒</option>
                                                        <option value="贝类毒素中毒">贝类毒素中毒</option>
                                                        <option value="横纹肌溶解综合症">横纹肌溶解综合症</option>
                                                        <option value="其它">其它</option>
                                                    </select>
                                                </div>
                                            </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">全身症状与体征</label>
                                    <div class="col-sm-10">
                                        <select class="form-control m-b" name="symptom">';
                                        echo '<option value="'.$row["symptom"].'">'.$row["symptom"].'</option>';
                                        echo '
                                            <option value="发热">发热</option>
                                            <option value="面色潮红">面色潮红</option>
                                            <option value="面色苍白">面色苍白</option>
                                            <option value="发绀">发绀</option>
                                            <option value="脱水">脱水</option>
                                            <option value="口渴">口渴</option>
                                            <option value="浮肿">浮肿</option>
                                            <option value="体重下降">体重下降</option>
                                            <option value="寒战">寒战</option>
                                            <option value="乏力">乏力</option>
                                            <option value="贫血">贫血</option>
                                            <option value="失眠">失眠</option>
                                            <option value="畏光">畏光</option>
                                            <option value="口有糊味">口有糊味</option>
                                            <option value="金属味">金属味</option>
                                            <option value="肥皂/咸味">肥皂/咸味</option>
                                            <option value="唾液过多">唾液过多</option>
                                            <option value="足/腕下垂">足/腕下垂</option>
                                            <option value="色素沉着">色素沉着</option>
                                            <option value="脱皮">脱皮</option>
                                            <option value="指甲出现白带">指甲出现白带</option>
                                            <option value="其它">其它</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">消化系统</label>
                                    <div class="col-sm-10">
                                        <select class="form-control m-b" name="digestive">';
                                    echo '<option value="'.$row["digestive"].'">'.$row["digestive"].'</option>';
                                    echo    '<option value="恶心">恶心</option>
                                            <option value="呕吐">呕吐</option>
                                            <option value="腹痛">腹痛</option>
                                            <option value="腹泻">腹泻</option>
                                            <option value="便秘">便秘</option>
                                            <option value="里急后重">里急后重</option>
                                            <option value="其他">其他</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">呼吸系统</label>
                                    <div class="col-sm-10">
                                        <select class="form-control m-b" name="respiratory">';
                                    echo '<option value="'.$row["respiratory"].'">'.$row["respiratory"].'</option>';
                                    echo '
                                            <option value="呼吸短促">呼吸短促</option>
                                            <option value="咯血">咯血</option>
                                            <option value="呼吸困难">呼吸困难</option>
                                            <option value="其它">其它</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">心脑血管系统</label>
                                    <div class="col-sm-10">
                                        <select class="form-control m-b" name="cardiovascular">';
                                    echo '<option value="'.$row["cardiovascular"].'">'.$row["cardiovascular"].'</option>';
                                    echo '
                                            <option value="胸闷">胸闷</option>
                                            <option value="胸痛">胸痛</option>
                                            <option value="心悸">心悸</option>
                                            <option value="气短">气短</option>
                                            <option value="其它">其它</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">泌尿系统</label>
                                    <div class="col-sm-10">
                                        <select class="form-control m-b" name="urinary">';
                                        echo '<option value="'.$row["urinary"].'">'.$row["urinary"].'</option>';
                                        echo '   <option value="尿量减少">尿量减少</option>
                                            <option value="背部肾区疼痛">背部肾区疼痛</option>
                                            <option value="尿中带血">尿中带血</option>
                                            <option value="肾结石">肾结石</option>
                                            <option value="其它">其它</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">神经系统</label>
                                    <div class="col-sm-10">
                                        <select class="form-control m-b" name="nervous">';
                                        echo '<option value="'.$row["nervous"].'">'.$row["nervous"].'</option>';
                                        echo    '<option value="头痛">头痛</option>
                                            <option value="眩晕">眩晕</option>
                                            <option value="昏迷">昏迷</option>
                                            <option value="抽搐">抽搐</option>
                                            <option value="惊厥">惊厥</option>
                                            <option value="谵妄">谵妄</option>
                                            <option value="瘫痪">瘫痪</option>
                                            <option value="言语困难">言语困难</option>
                                            <option value="吞咽困难">吞咽困难</option>
                                            <option value="感觉异常">感觉异常</option>
                                            <option value="精神失常">精神失常</option>
                                            <option value="视力模糊">视力模糊</option>
                                            <option value="眼睑下垂">眼睑下垂</option>
                                            <option value="肢体麻木">肢体麻木</option>
                                            <option value="末梢感觉障碍">末梢感觉障碍</option>
                                            <option value="瞳孔异常">瞳孔异常</option>
                                            <option value="针刺感">针刺感</option>
                                            <option value="其他">其他</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">皮肤和皮下组织</label>
                                    <div class="col-sm-10">
                                        <select class="form-control m-b" name="skin">';
                                        echo '<option value="'.$row["skin"].'">'.$row["skin"].'</option>';
                                        echo    '<option value="瘙痒">瘙痒</option>
                                            <option value="烧灼感">烧灼感</option>
                                            <option value="皮疹">皮疹</option>
                                            <option value="出血点">出血点</option>
                                            <option value="黄疸">黄疸</option>
                                            <option value="其他">其他</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-white" type="submit" onclick="editPatient()">保存内容</button>
                                        <button class="btn btn-white" type="submit">取消</button>
                                    </div>
                                </div>
                        </form>';
                        }
                    } else {
                        echo "0 结果";
                    }

                ?>
                <div class='ibox-content'>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="../js/jquery.min.js?v=2.1.4"></script>
<script src="../js/bootstrap.min.js?v=3.3.5"></script>
<script src="../js/content.min.js?v=1.0.0"></script>
<script src="../js/plugins/iCheck/icheck.min.js"></script>
<script src="../js/plugins/chosen/chosen.jquery.js"></script>
<script src="../js/plugins/jsKnob/jquery.knob.js"></script>
<script src="../js/plugins/jasny/jasny-bootstrap.min.js"></script>
<script src="../js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="../js/plugins/prettyfile/bootstrap-prettyfile.js"></script>
<script src="../js/plugins/nouslider/jquery.nouislider.min.js"></script>
<script src="../js/plugins/switchery/switchery.js"></script>
<script src="../js/plugins/ionRangeSlider/ion.rangeSlider.min.js"></script>
<script src="../js/plugins/iCheck/icheck.min.js"></script>
<script src="../js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="../js/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<script src="../js/plugins/clockpicker/clockpicker.js"></script>
<script src="../js/plugins/cropper/cropper.min.js"></script>
<script src="../js/demo/form-advanced-demo.min.js"></script>
<script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
<script>
    $(document).ready(function(){$(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",})});
    function editPatient(){
        $.ajax({
            //几个参数需要注意一下
            type: "POST",//方法类型
            dataType: "json",//预期服务器返回的数据类型
            url: './editPatient2.php',//url
            data: $('#add_value').serialize(),
            success: function (res) {
                console.log(res)
                if (res.code == 200) {
                    alert("患者修改成功！");
                    $(window).attr('location','./listPatient.php');
                };
            },
            error : function() {
                alert("患者修改失败！");
            }
        });
    }
</script>
<script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
</body>
</html>