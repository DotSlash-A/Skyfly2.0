<form method="post">
  <label for="place">Select a place:</label>
  <select name="place" id="place">
    <?php
    // fetch all distinct places from newtours table
    $places = $pdo->query("SELECT DISTINCT place FROM newtours")->fetchAll(PDO::FETCH_COLUMN);
    foreach ($places as $place) {
      echo "<option value=\"$place\">$place</option>";
    }
    ?>
  </select>
  <br>
  <label for="date">Select a date:</label>
  <input type="date" name="date" id="date">
  <br>
  <input type="submit" value="Search">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $place = $_POST['place'];
  $date = $_POST['date'];

  // fetch tours from newtours table that match the selected place and date
  $stmt = $pdo->prepare("SELECT * FROM newtours t INNER JOIN tourdate d ON t.Id = d.tour_id WHERE t.place = ? AND d.date = ?");
  $stmt->execute([$place, $date]);
  $tours = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if (count($tours) > 0) {
    echo "<h2>Tours available on $date in $place:</h2>";
    echo "<ul>";
    foreach ($tours as $tour) {
      echo "<li><strong>{$tour['description']}</strong> - \${$tour['price']}</li>";
    }
    echo "</ul>";
  } else {
    echo "<p>No tours available on $date in $place.</p>";
  }
}
?>
