<!--
    this file contains code that renders the navigation for the site
    it is included in the template
-->
<div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../">LMS</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <?php if($isStudent) print "<li><a href='index.php'>Home</a></li>";?>
                <?php if($isStaff) print "<li><a href='admin_index.php'>Home</a></li>";?>   
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Books <b class="caret"></b></a>
                    <!-- general navigation elements -->
                    <ul class="dropdown-menu">
                        <li><a href="books.php">All Books</a></li>
                        <li><a href="cats.php">Categories</a></li>
                        <li><a href="types.php">Book Types</a></li>
                        <?php if($isStaff or $isLibrarian) print "<li><a href='admin_add_book.php'>Add New Book</a></li>";?>
                        <li class="divider"></li>
                        <li><a href="authors.php">Authors</a></li>
                    </ul>
                </li>       
                <?php
                   if($isStaff){ // navigation elements below are rendered only if the user is admin
                     print "<li><a href='admin_bookings.php'>Reservations</a></li>";
                     $unread = Contact::filter("Contact", array("isRead"=>0));
                     $pendings = Student::filter("Student",array("isActive"=>0));
                     $unseen = Feedback::filter("Feedback", array("seen"=>0));
                     print "<li class='dropdown'>";
                     print "   <a href='#' class='dropdown-toggle' data-toggle='dropdown'>Notifications";
                     print "(";
                     print count($pendings) + count($unread) + count($unseen);
                     print ") <b class='caret'></b></a>";
                     print "   <ul class='dropdown-menu'>";
                     print "       <li><a href='admin_pending_regs.php'>Pending Registerations";
                     print "(". count($pendings). ")</a></li>";
                     print "       <li><a href='admin_inbox.php'>Inbox";
                     print "(". count($unread). ")</a></li>";
                     print "<li><a href='admin_requests.php'>Book Recommendations";
                     print "(". count($unseen). ")</a></li>";
                     print "   </ul>";
                     print "</li>";
                     print "<li class='dropdown'>";
                     print "   <a href='#' class='dropdown-toggle' data-toggle='dropdown'>New Staff <b class='caret'></b></a>";
                     print "   <ul class='dropdown-menu'>";
                     print "       <li><a href='admin_new_admin.php'>New Admin</a></li>";
                     print "       <li><a href='admin_new_librarian.php'>New Librarian</a></li>";
                     print "   </ul>";
                     print "</li>";
                     print "<li><a href='admin_users.php'>Users</a></li>";
                   }
                   if($isStudent){ //navigation elements peculiar to students
                     $rem_count = count($reminders['unclaimeds']) + count($reminders['unreturneds']) + count($reminders['overdues']);
                     print "<li><a href='user_notifications.php'>Reminders";
                     print "(". "{$rem_count}". ")";
                     print "</a></li>";
                     print "<li><a href='user_feedback.php'>Recommend a Book </a></li>";
                     print "<li><a href='user_contact.php'>Contact Us</a></li>";
                   }
               ?>
                <?php if($isStudent or $isStaff or $isLibrarian){ //navigation elements for any logged in user
                         print "<li class='dropdown'>";
                         print "   <a href='#' class='dropdown-toggle' data-toggle='dropdown'>Account<b class='caret'></b></a>";
                         print "   <ul class='dropdown-menu'>";
                         print "       <li><a href='logout.php'>Logout</a></li>";
                         print "       <li><a href='change_pswd.php'>Change Password</a></li>";
                         print "   </ul>";
                         print "</li>";
                     }
                ?>
                
                <!-- navigation elements for non registered users -->
                <?php if(!$isStudent and !$isStaff and !$isLibrarian) print "<li><a href='login.php'>Login</a></li>"; ?>
                <?php if(!$isStudent and !$isStaff and !$isLibrarian) print "<li><a href='user_register.php'>Register</a></li>"; ?>
            </ul>
            
            <!-- serach box -->
            <ul class="nav navbar-nav navbar-right">
                <form action="search_result.php" method="post">
                    <input type="search"  class="form-control" placeholder='search' name="q"/>
                    <input type="hidden" name="submit"  value="Search"/>
                </form>
            </ul>
        </div>
    </div>
</div>
 
 
 