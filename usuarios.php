<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">
	<title>UTI</title>
<!--	<link rel="stylesheet" type="text/css" href="js/jquery-easyui-1.8.8/themes/default/easyui.css"> -->
    <link rel="stylesheet" type="text/css" href="js/jquery-easyui-1.8.8/themes/bootstrap/easyui.css">
	<link rel="stylesheet" type="text/css" href="js/jquery-easyui-1.8.8/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="css/proyecto.css">
    <script type="text/javascript" src="js/jquery-easyui-1.8.8/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery-easyui-1.8.8/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="js/jquery-easyui-1.8.8/locale/easyui-lang-es.js"></script>
</head>
<body>  
  <?php include ('menu.php'); ?>
   
  <table id="dg" title="Lista de Usuarios" class="easyui-datagrid" style="width:100%;height:250px; margin:10px;"
            url="controlador/usuario.php?op=select"
            toolbar="#toolbar" pagination="false" 
            rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>               
                <th field="login" width="100">LOGIN</th>
                <th field="nombre" width="100">NOMBRE</th>
            </tr>
        </thead>
    </table>
    
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Nuevo</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Editar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Eliminar</a>
    </div>
    
    <div id="dlg" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
        <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
            <h3>User Information</h3>
            <div style="margin-bottom:10px">
                <input name="login" class="easyui-textbox" required="true" label="First Name:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="nombre" class="easyui-textbox" required="true" label="Last Name:" style="width:100%">
            </div> 
             
        </form>
    </div>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
    </div>
    <script type="text/javascript">
        var url;
        function newUser(){
            $('#dlg').dialog('open').dialog('center').dialog('setTitle','Ingresar Usuario');
            $('#fm').form('clear');
            url = 'controllers/usuario.php?op=insert';
        }
        function editUser(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $('#dlg').dialog('open').dialog('center').dialog('setTitle','Editar Usuario');
                $('#fm').form('load',row);
                url = 'controllers/usuario.php?op=edit&&id='+row.id;
            }
        }
        function saveUser(){
            $('#fm').form('submit',{
                url: url,
                onSubmit: function(){
                    return $(this).form('validate');
                },
                success: function(result){
                    var result = eval('('+result+')');
                    if (result.errorMsg){
                        $.messager.show({
                            title: 'Error',
                            msg: result.errorMsg
                        });
                    } else {
                        $('#dlg').dialog('close');      
                        $('#dg').datagrid('reload');   
                    }
                }
            });
        }
        function destroyUser(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $.messager.confirm('Confirmar','¿Estás seguro de Eliminar el item seleccionado?',function(r){
                    if (r){
                        $.post('controllers/usuario.php?op=delete',{id:row.id},function(result){
                            if (result.success){
                                $('#dg').datagrid('reload');    
                            } else {
                                $.messager.show({    
                                    title: 'Error',
                                    msg: result.errorMsg
                                });
                            }
                        },'json');
                    }
                });
            }
        }
    </script>    

    
</body>
</html>