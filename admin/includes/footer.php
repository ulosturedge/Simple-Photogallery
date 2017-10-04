</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Views',  <?php echo $session->count; ?>],
            ['Comments',   <?php echo Comment::count_all(); ?>],
            ['Users',  <?php echo User::count_all(); ?>],
            ['Photos', <?php echo Photo::count_all(); ?>],
            ['Sleep',    0]
        ]);

        var options = {
            title: 'My Daily Activities',
            pieSliceText: 'label',
            is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
    }
</script>

<!-- WYSIWYG editor -->

<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>
<script src="js/dropzone.js"></script>
<script src="js/script.js"></script>

</body>

</html>
