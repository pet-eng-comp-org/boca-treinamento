<?php



?>

 <html>
 <head>
<style>
#grad1 {
	height:100%;
	width: 100%;
	/* background-image:url("../images/background1.png"); */
	background-color: #21201E;
	overflow:hidden;
  }
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel=stylesheet href="../Css.php" type="text/css">

  <title>Cadastro BOCA de Treinamento</title>
 </head>
 <body id="grad1">

 <table align="center" valign="middle" width="100%" height="100%">
	<tr align="center" valign="middle"> 
	    <td> 
	      <form name="form1" action="register.php" method="POST">
	        <div align="center"> 
	          <table class="login-table" border="0" align="center">
	            <tr> 
	              <td nowrap>
									<div align="center">
										<img src="../images/topcom23.png" width="280" title="Logo do TOPCOM" alt="Logo do TOPCOM" />
									</div>
									<div>
									<?php echo "<p style='color:#2f2f32'>Bem vindo ao cadastro do BOCA de Treinamento do TOPCOM</p>";
										echo "<p></p>";
									
									?>
									</div>
	              </td>
	            </tr>
							<tr>
								<td>
									<br><br><br>
								</td>
							</tr>
	       		</tr>
	              <td valign="top"> 
	                <table width="100%" border="0" align="left">
	                  <tr>
	                  	<td style="color:#2f2f32">Usuário:</td>
	                  	<td width="50%"><input class="login-input" height="100%" type="text" name="username" placeholder="USERNAME"></td>
	                  </tr>
	                  <tr>
	                  	<td style="color:#2f2f32">Nome Completo:</td>
	                  	<td width="50%"><input class="login-input" height="100%" type="text" name="fullname" placeholder="FULLNAME"></td>
	                  </tr>
	                  <tr>
	                  	<td style="color:#2f2f32">Confirme seu E-mail:</td>
	                  	<td width="50%"><input class="login-input" height="100%" type="text" name="email0" placeholder="E-MAIL"></td>
	                  </tr>
	                  <tr>
	                  	<td style="color:#2f2f32">Senha:</td>
	                  	<td width="50%"><input class="login-input" height="100%" type="password" name="passwordn1" placeholder="PASSWORD"></td>
	                  </tr>
	                  <tr>
	                  	<td style="color:#2f2f32">Confirme a senha:</td>
	                   	<td width="50%"><input class="login-input" height="100%" type="password" name="passwordn2" placeholder="RETYPE PASSWORD"></td>
	                  </tr>
	                </table>
	              </td>
	            </tr>
							<tr>
								<td align="center">
									<input class="login-button" type="submit" name="Submit" value="Cadastrar">
								</td>
							</tr>
	          </table>
	        </div>
	      </form>
	    </td>
	  </tr>
	</table>
 </body>
</html>

