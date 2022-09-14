<form action="" method="post">
<div class="form-group">
                  <label>Minimal</label>
                  <select name="select" class="form-control select2" style="width: 100%;">
                    <option selected="selected">Alabama</option>
                    <option>Alaska</option>
                  </select>
                </div>

                <input type="submit" name="click" value="click">

                <?php 
                if (isset($_POST['click'])) {
                    var_dump($_POST);
                }
                ?>
</form>