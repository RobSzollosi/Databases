<!DOCTYPE html>
<html>
<head>
	<title>Western Course Data</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<!-- <link href="https://fonts.googleapis.com/css?family=Mali" rel="stylesheet"> -->
</head>
<body>

<!-- <script src="museum.js"></script>; -->

<?php
    include "connecttodb.php";
?>


<h1>Western Courses and Equivalencies</h1>

<!-- List all of the western course data -->
<h2>View Western Course Data</h2>

<form action="getUWOCourses.php" method="post">

<h3>Sort the courses by:</h3>
<input type="radio" name="field" id="course_number" value="course_number" required>
<label for="course_number">Course Number</label><br>
<input type="radio" name="field" id="course_name" value="course_name" required>
<label for="course_name">Course Name</label><br>

<h3>In the following order:</h3>
<input type="radio" name="order" id="ASC" value="ASC" required>
<label for="ASC">Ascending</label><br>
<input type="radio" name="order" id="DESC" value="DESC" required>
<label for="DESC">Descending</label><br>

<input type="submit" value="List Western Course Data">
</form>
<br>
<hr>

<!-- Allow the user to enter a new Western Course. The user should be able to enter all the information. -->
<!-- If the user enters a course number that already exists, give the user a warning message and do not  -->
<!-- allow it to be entered into the system. Make sure the user follows the rules of the course number  -->
<!-- starting with cs (it is up to you how you enforce that).  -->
<h2>Add a new Western Course</h2>

<form action="addUWOCourse.php" method="post">

<h3>Input the 4 digit course code (where the cose is the x's in "csxxxx" )</h3>
CS<input type="text" name="newCourseCode" maxlength ="4", minlength = "4" pattern = "\d{4}" required>

<h3>Input the Name for the new course:</h3>

<input type="text" name="newCourseName" maxlength ="50", minlength = "1" required>
<br>


<h3>Select the Suffix for the course:</h3>

<input type="radio" name="suffix" value="A/B" required>
<label for="A/B">A/B</label>
<input type="radio" name="suffix" value="F/G" required>
<label for="F/G">F/G</label><br>
<input type="radio" name="suffix" value="E" required>
<label for="E">E</label>
<input type="radio" name="suffix" value="Y" required>
<label for="Y">Y</label>
<input type="radio" name="suffix" value="Z" required>
<label for="Z">Z</label><br>
<input type="radio" name="suffix" value="" required>
<label for="">Full Year Course</label><br>

<h3>Select the weight of the course:</h3>

<input type="radio" name="courseWeight" value="0.5" required>
<label for="0.5">0.5 Credits</label><br>
<input type="radio" name="courseWeight" value="1.0" required>
<label for="1.0">1.0 Credits</label>

<input type="submit" value="Add this course">

</form>
<br>
<hr>


<!-- Allow the user to select a university from the list of universities names in order by -->
<!-- province and then see all the university information and see all that university's courses.  -->
<h2>Select a university to view the courses of</h2>

<form action = displayUniCourses.php method = "post">

<?php
    include "getUnis.php";
?>
<input type="submit" value="List University Course Data">
</form>
<br>
<hr>

<!-- Allow the user to select a province code and see all the university names and nicknames  from that province. -->
<h2>Select a Province to view universities from that province</h2>

<form action = "displayProvUnis.php" method = "post">

<?php
	include "getProvs.php";
?>
<input type="submit" value="List Universities from the Province">
</form>
<br>
<hr>

<!-- Allow the user to select a Western course by number  and see the name and the number and the weight of the western -->
<!-- course and see the university name and the outside course name and outside course number and weight of all outside -->
<!-- courses it is equivalent to.  Also show the date this equivalency was made.  -->
<h2>Select the Course Number of a Western Course to View its Equivilancies</h2>

<form action = "displayEquivs.php" method = "post">

<?php
	include "getCourseCode.php";
?>
<input type="submit" value="List Equivalencies">
</form>
<br>
<hr>

<!-- Allow the user to select a date and then show all equivalencies made before and including that date. For this query  -->
<!-- show the same information as in the previous bullet point.  -->
<h2> Select a Data to see Equivalencies Made Before and Including it </h2>

<form action = "displayEquivsBefore.php" method = "post">
	<label for= "equivDay">Date: </label>
	<input type = "date" id = "equivDay" name = "equivDay">
<input type="submit" value="List Equivalencies">
</form>
<br>
<hr>

<!-- Allow the user to create a new equivalency between an existing outside course and an existing Western course.  Make  -->
<!-- the equivalency date to be the current date.  If the user is trying to create an equivalency that already exists,  -->
<!-- then just modify that row in the table by updating  the date to today's date. -->
<h2> Create or Update an Equivalency Between a Western course and an Outside Course </h2>

<form action = "modifyEquiv.php" method = "post">

<?php
	include "getAllCourses.php";
?>
<input type="submit" value="Update Equivalencies">
</form>
<br>
<hr>

<!-- List the names and nicknames of universities that are in our system but do not have any courses associated with them.  -->
<h2> Universities in our Database that do not have courses associated with them </h2>
<?php
	include "courselessUnis.php";
?>
<br>
<hr>

<?php
mysqli_close($connection);
?>

</body>
</html>