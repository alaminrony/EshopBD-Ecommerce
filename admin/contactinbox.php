<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
   $filepath = realpath(dirname(__FILE__));

    include_once ($filepath.'/../classess/Contact.php');
    include_once ($filepath.'/../helpers/Format.php');

   $contact= new Contact();
   $fm = new Format();
    
?>

<?php
   if (isset($_GET['delMsgId'])) {
    	$delid =$_GET['delMsgId'];
    	
    	$remove = $contact->MassageDeletedById($delid);
    	
    	
    }
?>





        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <div class="block"> 
                
                <?php
                if (isset($remove)) {
                	echo $remove;
                }

                ?>      
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Contact ID</th>
							<th>Name</th>
							<th>Email</th>
							<th>phone</th>
							<th>Massage</th>
							<th>Action</th>
							
						</tr>
					</thead>
					<tbody>
						<?php
						  
						  
						   $getContactData = $contact->getContactData();
						   if ($getContactData) {
						   	while ($result =  $getContactData->fetch_assoc()) {						   	
						   

						?>
						<tr class="odd gradeX">
							<td><?php echo $result['contact_id']?></a></td>
							
							<td><?php echo $result['name']?></td>
							<td><?php echo $result['email']?></td>
							<td><?php echo $result['mobile']?></td>
							<td><a href="massage.php?cont_id=<?php echo $result['contact_id']?>">View Massage</a></td>

							<td><a href="?delMsgId=<?php echo $result['contact_id']?> ">Remove</a></td>
							
						
						<?php }}?>
						
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
