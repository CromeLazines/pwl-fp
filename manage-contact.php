<?php 
    include("partial/header.php");
    require("env.php");
    include("admin-menu.php")
    ?> 
<div class="container">
    <div class="page-heading">
        <section class="section">
            <div class="row">
                <div class="col-12 py-4">
                    <?php
                    session_start();
                    if(isset($_SESSION['Flash_data'])){
                        $pesan = $_SESSION['Flash_data'];
                        unset($_SESSION['Flash_data']);
                        echo $pesan;
                    }
                    ?>
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h4 class="card-title">Data Contact</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="table">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Pesan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $sql = "SELECT id,nama,email,pesan FROM tbl_contact";
                                            $hasil = mysqli_query($con,$sql) or exit("Error query: <b>".$sql."</b>.");

                                            while($data = mysqli_fetch_assoc($hasil)){
                                        ?>
                                        <tr>
                                            <td><?php echo $data['id']; ?></td>
                                            <td><?php echo $data['nama']; ?></td>
                                            <td><?php echo $data['email']; ?></td>
                                            <td><?php echo $data['pesan']; ?></td>
                                            <td></td>
                                            <td>
                                                <div class="dropdown show">
                                                    <a class="btn btn-primary dropdown-toggle me-1"
                                                        type="button" id="dropdownMenuButton"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        Aksi
                                                    </a>

                                                    <div class="dropdown-menu"
                                                    aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" href="edit.php?id=<?=$data['id']?>">Edit</a>
                                                        <a class="dropdown-item" href="contact-delete.php?id=<?=$data['id']?>">Hapus</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

</div>
<?php include("partial/footer.php"); ?>