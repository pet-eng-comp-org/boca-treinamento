<!-- 1710016697 --> <?php exit; ?>	0
<br>
<table width="100%" border=1>
 <tr>
  <td><b>Run #</b></td>
<td><b>Time</b></td>
  <td><b>Problem</b></td>
  <td><b>Language</b></td>
  <td><b>Answer</b></td>
  <td><b>File</b></td>
 </tr>
</table><br><center><b><font color="#ff0000">NO RUNS AVAILABLE</font></b></center><br><br><center><b>To submit a program, just fill in the following fields:</b></center>
<form name="form1" enctype="multipart/form-data" method="post" action="run.php">
  <input type=hidden name="confirmation" value="noconfirm" />
  <center>
    <table border="0">
      <tr> 
        <td width="25%" align=right>Problem:</td>
        <td width="75%">
          <select name="problem" onclick="Arquivo()">
<option selected value="-1"> -- </option>
	  </select>
        </td>
      </tr>
      <tr> 
        <td width="25%" align=right>Language:</td>
        <td width="75%"> 
          <select name="language" onclick="Arquivo()">
<option selected value="-1"> -- </option>
<option value="1">C</option>
<option value="2">C++11</option>
<option value="3">Java</option>
<option value="4">Python2</option>
<option value="5">Python3</option>
	  </select>
        </td>
      </tr>
      <tr> 
        <td width="25%" align=right>Source code:</td>
        <td width="75%">
	  <input type="file" name="sourcefile" size="40" onclick="Arquivo()">
        </td>
      </tr>
    </table>
  </center>
  <script language="javascript">
    function conf() {
      if (document.form1.problem.value != '-1' && document.form1.language.value != '-1') {
       if (confirm("Confirm submission?")) {
        document.form1.confirmation.value='confirm';
       }
      } else {
        alert('Invalid problem and/or language');
      }
    }
  </script>
  <center>
      <input type="submit" name="Submit" value="Send" onClick="conf()">
      <input type="reset" name="Submit2" value="Clear">
  </center>
</form>
