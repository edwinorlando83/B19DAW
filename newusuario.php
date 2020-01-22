<div id="p" class="easyui-panel" title="Ingreso de Usuarios" style="width:100%;height:100%; ">
<form id="frmUSuario" method="post"     style="margin:0;padding:20px 50px">
           
            <div style="margin-bottom:5px">
                <input name="login" labelPosition="top" class="easyui-textbox" required="true" label="Login:" style="width:80%">
            </div>
            <div style="margin-bottom:5px">
                <input name="nombre" labelPosition="top" class="easyui-textbox" required="true" label="Nombre Completo:" style="width:80%" >
            </div>              
            <div style="margin-bottom:5px">
                <input id="password" name="password" labelPosition="top" class="easyui-passwordbox" required="true" label="Password:" style="width:80%" >
            </div> 
            <div style="margin-bottom:5px">
                 <input  id="repassword" name="repassword"  validType="confirmPass['#password']" class="easyui-passwordbox" labelPosition="top"   iconWidth="28" required="true" label="Repetir Password:" style="width:80%" >
            </div> 

            <div style="margin-bottom:5px">
            <input name ="fechanacimiento" class="easyui-datebox" label="Fecha de Nacimiento:" labelPosition="top" style="width:40%;">
        </div>

            <div style="margin-bottom:5px">
            <input  name="image"  class="easyui-filebox" label="foto:" labelPosition="top" data-options="prompt:'Buscar imagen...'" style="width:40%">
            </div>
            <div style="margin-bottom:5px">

            <select  name ="codigo_rol" class="easyui-combobox"  labelPosition="top" 
            style="width:40%;"  data-options="
                    url:'controlador/rol.php?op=select',
                    method:'get',
                    valueField:'codigo',
                    textField:'nombre',
                    panelHeight:'auto',
                    label: 'rol de usuario:',
                    labelPosition: 'top'
                    ">               
            </select>

            </div>
         

        </form>
   
        <div style="text-align:center;padding:5px 0">
        <a href="javascript:void(0)" id='btnSave' class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Save</a>
        <a  href="main.php?pag=listausuario" class="easyui-linkbutton" iconCls="icon-cancel" style="width:90px">Cancel</a>
    </div>   

    </div>
    
 
    <script type="text/javascript">
       
       //https://www.jeasyui.com/easyui/demo/passwordbox/validatepassword.html

        $.extend($.fn.validatebox.defaults.rules, {
			confirmPass: {
				validator: function(value, param){
					var pass = $(param[0]).passwordbox('getValue');
					return value == pass;
				},
				message: 'La confrmación no coincide con la contraseña.'
			}
		})

        function saveUser(){              
           $('#frmUSuario').form('submit',{
                url: 'controlador/usuario.php?op=insert',
                onSubmit: function(){
                    var esvalido =  $(this).form('validate');
                    if( esvalido){
                        $.messager.progress({
                       title:'Por favor espere',
                      msg:'Cargando datos...'
                      });
                    }
                    return esvalido;
                },
                success: function(result){                   
                    $.messager.progress('close');
                    var result = eval('('+result+')');
                    console.log(result);                  
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


        
    </script>    

    
 