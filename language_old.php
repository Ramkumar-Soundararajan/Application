<?php 
require("db/db_connect.php");
session_start();
if(!isset($_SESSION["login"])) header ("location:index.php");
$access_type = $_SESSION["access_type"];

?>
<link rel="stylesheet" href="css/language/bootstrap.min.css">
<script src="js/language/jquery.min.js"></script>
<script src="js/language/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#language").click();
    });
function submitLanguageForm() {
var language_dd = $('#language_dd').val();
if(language_dd.trim() == '' ){
        alert('Please Choose Language.');
        $('#language_dd').focus();
        return false;
    } else {
		var access_type = "<?php echo $access_type ?>";
		if (access_type == 1){
			window.location.href = 'eti/addview.php?language_id='+language_dd;
		} else {
			window.location.href = 'dashboard/dashboard.php?language_id='+language_dd;
		}
		 
	}
}  
function submitLanguageCancel() {
        window.location.href = 'logout.php';
}
</script>
<button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm" id="language" name="language" style="display: none;">
    Language
</button>

<!-- Modal -->
<div class="modal fade" id="modalForm" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Please Choose Language</h4>
            </div>
            <form role="form" method="POST" action="language.php">
            <!-- Modal Body -->
            <div class="modal-body">
                <p class="statusMsg"></p>
                    <div class="form-group">
                        <label for="inputName">Language</label>
                        <select type='select' class="form-control" id="language_dd" name="language_dd">
                          <?php  
							echo '<option value="" selected="selected" >Select the Language</option>';
							?>	
				
				<?php
				$query2="select id,lang_name,lang_code from eti_lang_master where deleted='0'";
				$exec2=mysql_query($query2) or die ("Error in Query2".mysql_error());
				while($res2=mysql_fetch_array($exec2))
				{
				$lang_id = $res2['id'];
				$lang_code=$res2['lang_code'];
				$lang_name=$res2['lang_name'];
				?>
				<option value="<?php echo $lang_code; ?> "><?php echo $lang_name; ?></option>
				<?php }?>
                        </select>
                    </div>
               
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button"  class="btn btn-default" data-dismiss="modal" onclick="submitLanguageCancel()">Close</button>
                <button type="button" name="submit" id="submit" class="btn btn-primary submitBtn" onclick="submitLanguageForm()">SUBMIT</button>
            </div>
          </form>
        </div>
    </div>
</div>