<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>UTI</title>
	<link rel="stylesheet" type="text/css" href="js/jquery-easyui-1.8.8/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="js/jquery-easyui-1.8.8/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="css/proyecto.css">
	<script type="text/javascript" src="js/jquery-easyui-1.8.8/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery-easyui-1.8.8/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="js/jquery-easyui-1.8.8/locale/easyui-lang-es.js"></script>
    
</head>
<body class="easyui-layout">
<div id="p" class="easyui-panel" title="Basic Panel" style="width:700px;height:400px;padding:10px;">
<div style="margin-bottom:20px">
            <input class="easyui-numberbox" id="txtCedula" label="Cedula:"    labelPosition="top"   style="width:100%;">
        </div>

        <div style="margin-bottom:20px">
            <input class="easyui-textbox" label="Nombre:" labelPosition="top" style="width:100%;">
        </div>
        <a href="#" id="btnClick" class="easyui-linkbutton" data-options="iconCls:'icon-add'">Add</a>
    </div>

    <script type="text/javascript">
         
         $( "#btnClick" ).click(function() {           
           
         });

        
    </script>

</body>
</html>