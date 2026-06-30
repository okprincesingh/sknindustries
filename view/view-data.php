<?php
include "../admin/config/connection.php";
if (isset($_POST['latestblog'])) {
    $sql = "SELECT * FROM blog ORDER BY id DESC LIMIT 4";
    $query = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($query)) {
        $id = $row['id'];
        $title = $row['title'];
        $titlenew_url = str_replace(' ', '-', $title);
        $image = $row['image'];
        $date = $row['date'];
        $description = $row['description'];
        $slug_url = $row['slug_url'];
        echo '<div class="swiper-slide">
                                    <div class="blogCard">
                                        <div class="blogImg">
                                            <img src="./blog/images/' . $image . '" alt="Blog Img">
                                        </div>
                                        <div class="blogCardContent">
                                            <h3>' . $title . '</h3>
                                            <p>' . substr($description, 0, 100) . '...
                                            </p>
                                            <a href="blog-detail-' . $titlenew_url . '">Read
                                                More</a>
                                        </div>
                                    </div>
                                </div>';
    }
}
?>