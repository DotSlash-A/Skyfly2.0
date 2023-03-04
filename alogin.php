<?
session_start();

// Step 1: Establish a database connection
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "testdb";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Step 2: Handle login form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $usertype = $_POST['usertype'];

    // Step 3: Check if user exists
    $user_query = "SELECT id, usertype FROM users WHERE username='$username' AND password='$password'";
    $user_result = mysqli_query($conn, $user_query);

    if (mysqli_num_rows($user_result) == 1) {
        // Step 4: Store user_id and usertype in session
        $user = mysqli_fetch_assoc($user_result);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['usertype'] = $user['usertype'];

        // Step 5: Redirect user to dashboard
        header("Location: auserbook.php");
        exit();
    } else {
        echo "Invalid username or password";
    }
}
?>

<h2>Login</h2>
<form method="POST">
    <div>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div>
        <label for="usertype">User Type:</label>
        <select id="usertype" name="usertype">
            <option value="user" selected>User</option>
            <option value="admin">Admin</option>
        </select>
    </div>
    <button type="submit">Login</button>
</form>
