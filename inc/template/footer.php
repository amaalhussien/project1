</div>
<div class="copyright" style="position: static;
  width: 100%; 
      ">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 text-center text-sm-left text-uppercase">
           2019/2/18 &copy;
          </div>
          <div class="col-sm-6 text-center text-sm-right">
            <ul class="list-unstyled">
              <li>
                <a href="#"><i class="fa fa-facebook"></i></a>
              </li>
              <li>
                <a href="#"><i class="fa fa-twitter"></i></a>
              </li>
              <li>
                <a href="#"><i class="fa fa-youtube"></i></a>
              </li>
              <li>
                <a href="#"><i class="fa fa-google-plus"></i></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>	








   
    

   
    <script src="<?php echo $js ?>tabel/jquery-3.3.1.js"></script>
    <script src="<?php echo $js ?>tabel/jquery.dataTables.min.js"></script>
		<script src="<?php echo $js ?>jquery-ui.min.js"></script>
    <script src="<?php echo $js ?>popper.min.js"></script>
		<script src="<?php echo $js ?>bootstrap.min.js"></script>
   <script src="<?php echo $js ?>tabel/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo $js ?>tabel/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo $js ?>tabel/dataTables.responsive.min.js"></script>  
    <script src="<?php echo $js ?>tabel/responsive.bootstrap.min.js"></script>
		<script src="<?php echo $js ?>jquery.selectBoxIt.min.js"></script>
    <script src="<?php echo $js ?>main.js"></script>
    <script src="<?php echo $js ?>tabel.js"></script>
    <script src="<?php echo $js ?>as.js"></script>
    <script>
    
$(document).ready(function() {
    var table = $('#example').DataTable({
        responsive: true
    });

    new $.fn.dataTable.FixedHeader(table);
});
</script>
	

	
	</body>
</html>

