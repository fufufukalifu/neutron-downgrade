<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/css/jquery.datatables.min.css'); ?>">


<!-- konten -->





<div class="row">


    <div class="col-md-12">


        <div class="panel panel-default">


            <div class="panel-heading">


                <h5 class="panel-title">Daftar Tingkat Mata Pelajaran</h5>


                <!-- Trigger the modal with a button -->


                <button title="Tambah Data" type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#myModal" style="margin-top:-30px;" ><i class="ico-plus"></i></button>


                <br>


                <!--<a data-toggle="modal" class="btn btn-default pull-right"  "  data-target="#myModal">Tambah</a>-->


            </div>


            <ul class="nav nav-tabs">


                <li class="active"><a href="#tingkatSD" data-toggle="tab">SD</a></li>


                <li><a href="#tingkatSMP" data-toggle="tab">SMP</a></li>


                <li><a href="#tingkatSMA" data-toggle="tab">SMA</a></li>


                <li><a href="#tingkatSMA-IPA" data-toggle="tab">SMA IPA</a></li>


                <li><a href="#tingkatSMA-IPS" data-toggle="tab">SMA IPS</a></li>


            </ul>


            <!--/ tab -->


            <!-- tab content -->


            <div class="tab-content">


                <div class="tab-pane active" id="tingkatSD">


                    <table class="table table-striped" id="zero-configuration" style="font-size: 13px">


                        <thead>


                            <tr>


                                <th class="text-center">ID</th>


                                <th>Nama Mata Pelajaran</th>


                                <th>Keterangan</th>


                                <th>BAB</th>


                                <th class="text-center">Aksi</th>


                            </tr>


                        </thead>


                        <tbody>


                            <?php foreach ($mapelsd as $mapel): ?>


                                <tr>


                                    <td class="text-center"><?= $mapel->id ?> </td>


                                    <td><?= $mapel->namaMataPelajaran ?> </td>


                                    <td><?= $mapel->keterangan ?></td>


                                    <td><a href="<?= base_url('index.php/admin/daftarbab/' . $mapel->namaMataPelajaran . '/' . $mapel->id); ?>" class="btn btn-default">Lihat</a></td>


                                    <td class="text-center">


                                        <button type="button" id="rubahBtn" class="btn btn-default" data-toggle="modal" data-target="#modalRubah<?= $mapel->id ?>" title="Rubah Data"><i class="ico-file5"></i></button>


                                        <button type="button" id="hapusBtn" class="btn btn-default" data-toggle="modal" data-id="<?= $mapel->id ?>" title="Hapus Data"><i class="ico-remove"></i></button>


                                    </td>


                                    <!-- Modal -->


                                </tr>


                            <div id="modalRubah<?= $mapel->id ?>" class="modal fade" role="dialog">


                                <div class="modal-dialog">


                                    <!-- Modal content-->


                                    <div class="modal-content">


                                        <div class="modal-header">


                                            <button type="button" class="close" data-dismiss="modal">&times;</button>


                                            <h4 class="modal-title">Rubah Data Tingkat Mata Pelajaran</h4>


                                        </div>


                                        <form action="<?= base_url('index.php/admin/rubahtingkatMP') ?>" method="post">


                                            <div class="modal-body">


                                                <div class="form-group input-group">


                                                    <span class="input-group-addon"><i class="ico-notebook"></i></span>


                                                    <input name="keterangan" id="keterangan" type="text" class="form-control" value="<?= $mapel->keterangan ?>" placeholder="Keterangan Mata Pelajaran" required> <br>


                                                    <input name="idtingkatMP" type="hidden" value="<?= $mapel->id ?>" >





                                                </div>


                                                <div class="form-group input-group">


                                                    <span class="input-group-addon"><i class="ico-notebook"></i></span>


                                                    <select class="form-control" name="tingkatMP">


                                                        <option>Pilih Tingkat Mata Pelajaran</option>> 


                                                        <option value="<?= $mapel->tingkatID ?>" selected> 


                                                            <?php


                                                            if ($mapel->tingkatID == 1) {


                                                                echo 'SD';


                                                            } else if ($mapel->tingkatID == 2) {


                                                                echo 'SMP';


                                                            } else if ($mapel->tingkatID == 3) {


                                                                echo 'SMA ';


                                                            } else if ($mapel->tingkatID == 4) {


                                                                echo 'SMA - IPA';


                                                            } else if ($mapel->tingkatID == 5) {


                                                                echo 'SMA - IPS';


                                                            }else {


                                                                echo 'Tidak mempunyai tingkatan';


                                                            }


                                                            ?> </option>


                                                        <option value="1">SD</option>


                                                        <option value="2">SMP</option>


                                                        <option value="3">SMA</option>


                                                        <option value="4">SMA - IPA</option>

                                                        <option value="5">SMA - IPS</option>



                                                    </select>


                                                </div>


                                                <div class="form-group input-group">


                                                    <span class="input-group-addon"><i class="ico-notebook"></i></span>


                                                    <select class="form-control" name="idMP">


                                                        <option>Pilih Mata Pelajaran</option>


                                                        <option value="<?= $mapel->matapelajaranID ?>" selected> <?= $mapel->namaMataPelajaran ?></option>


                                                        <?php foreach ($mapels as $mapel): ?>


                                                            <option value="<?= $mapel->id ?>"><?= $mapel->namaMataPelajaran ?></option>


                                                        <?php endforeach ?>


                                                    </select>


                                                </div>


                                            </div>


                                            <div class="modal-footer">


                                                <button type="submit" class="btn btn-primary">Simpan</button>


                                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>


                                            </div>


                                        </form>


                                    </div>


                                </div>


                            </div>


                        <?php endforeach ?>


                        </tbody>


                    </table>


                </div>


                <div class="tab-pane" id="tingkatSMP">


                    <!--<table class="table table-striped" id="mapelsmp" style="font-size: 13px">-->


                    <table id="" class="table table-striped display" cellspacing="0" width="100%">


                        <thead>


                            <tr>


                                <th class="text-center">ID</th>


                                <th>Nama Mata Pelajaran</th>


                                <th>Keterangan</th>


                                <th>BAB</th>


                                <th class="text-center">Aksi</th>


                            </tr>


                        </thead>


                        <tbody>


                            <?php foreach ($mapelsmp as $mapel): ?>


                                <tr>


                                    <td class="text-center"><?= $mapel->id ?></td>


                                    <td><?= $mapel->namaMataPelajaran ?></td>


                                    <td><?= $mapel->keterangan ?></td>


                                    <td><a href="<?= base_url('index.php/admin/daftarbab/' . $mapel->namaMataPelajaran . '/' . $mapel->id); ?>" class="btn btn-default">Lihat</a></td>


                                    <td class="text-center">


                                        <button type="button" id="rubahBtn" class="btn btn-default" data-toggle="modal" data-target="#modalRubah<?= $mapel->id ?>" title="Rubah Data"><i class="ico-file5"></i></button>


                                        <button type="button" id="hapusBtn" class="btn btn-default" data-toggle="modal" data-id="<?= $mapel->id ?>" title="Hapus Data"><i class="ico-remove"></i></button>


                                    </td>


                                    <!-- Modal -->


                                </tr>


                            <div id="modalRubah<?= $mapel->id ?>" class="modal fade" role="dialog">


                                <div class="modal-dialog">


                                    <!-- Modal content-->


                                    <div class="modal-content">


                                        <div class="modal-header">


                                            <button type="button" class="close" data-dismiss="modal">&times;</button>


                                            <h4 class="modal-title">Rubah Data Tingkat Mata Pelajaran</h4>


                                        </div>


                                        <form action="<?= base_url('index.php/admin/rubahtingkatMP') ?>" method="post">


                                            <div class="modal-body">


                                                <div class="form-group input-group">


                                                    <span class="input-group-addon"><i class="ico-notebook"></i></span>


                                                    <input name="keterangan" id="keterangan" type="text" class="form-control" value="<?= $mapel->keterangan ?>" placeholder="Keterangan Mata Pelajaran" required> <br>


                                                    <input name="idtingkatMP" type="hidden" value="<?= $mapel->id ?>" >





                                                </div>


                                                <div class="form-group input-group">


                                                    <span class="input-group-addon"><i class="ico-notebook"></i></span>


                                                    <select class="form-control" name="tingkatMP">


                                                        <option>Pilih Tingkat Mata Pelajaran</option>> 


                                                        <option value="<?= $mapel->tingkatID ?>" selected> 


                                                       
                                                            <?php


                                                            if ($mapel->tingkatID == 1) {


                                                                echo 'SD';


                                                            } else if ($mapel->tingkatID == 2) {


                                                                echo 'SMP';


                                                            } else if ($mapel->tingkatID == 3) {


                                                                echo 'SMA ';


                                                            } else if ($mapel->tingkatID == 4) {


                                                                echo 'SMA - IPA';


                                                            } else if ($mapel->tingkatID == 5) {


                                                                echo 'SMA - IPS';


                                                            }else {


                                                                echo 'Tidak mempunyai tingkatan';


                                                            }


                                                            ?> </option>


                                                        <option value="1">SD</option>


                                                        <option value="2">SMP</option>


                                                        <option value="3">SMA</option>


                                                        <option value="4">SMA - IPA</option>

                                                        <option value="5">SMA - IPS</option>


                                                    </select>


                                                </div>


                                                <div class="form-group input-group">


                                                    <span class="input-group-addon"><i class="ico-notebook"></i></span>


                                                    <select class="form-control" name="idMP">


                                                        <option>Pilih Mata Pelajaran</option>


                                                        <option value="<?= $mapel->matapelajaranID ?>" selected> <?= $mapel->namaMataPelajaran ?></option>


                                                        <?php foreach ($mapels as $mapel): ?>


                                                            <option value="<?= $mapel->id ?>"><?= $mapel->namaMataPelajaran ?></option>


                                                        <?php endforeach ?>


                                                    </select>


                                                </div>


                                            </div>


                                            <div class="modal-footer">


                                                <button type="submit" class="btn btn-primary">Simpan</button>


                                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>


                                            </div>


                                        </form>


                                    </div>


                                </div>


                            </div>


                        <?php endforeach ?>


                        </tbody>


                    </table>


                </div>


                <div class="tab-pane" id="tingkatSMA">


                    <!--<table class="table table-striped" id="mapelsmp" style="font-size: 13px">-->


                    <table id="" class="table table-striped display" cellspacing="0" width="100%">


                        <thead>


                            <tr>


                                <th class="text-center">ID</th>


                                <th>Nama Mata Pelajaran</th>


                                <th>Keterangan</th>


                                <th>BAB</th>


                                <th class="text-center">Aksi</th>


                            </tr>


                        </thead>


                        <tbody>


                            <?php foreach ($mapelsma as $mapel): ?>


                                <tr>


                                    <td class="text-center"><?= $mapel->id ?>  </td>


                                    <td><?= $mapel->namaMataPelajaran ?></td>


                                    <td><?= $mapel->keterangan ?></td>


                                    <td><a href="<?= base_url('index.php/admin/daftarbab/' . $mapel->namaMataPelajaran . '/' . $mapel->id); ?>" class="btn btn-default">Lihat</a></td>


                                    <td class="text-center">


                                        <button type="button" id="rubahBtn" class="btn btn-default" data-toggle="modal" data-target="#modalRubah<?= $mapel->id ?>" title="Rubah Data"><i class="ico-file5"></i></button>


                                        <button type="button" id="hapusBtn" class="btn btn-default" data-toggle="modal" data-id="<?= $mapel->id ?>" title="Hapus Data"><i class="ico-remove"></i></button>


                                    </td>


                                    <!-- Modal -->


                                </tr>


                            <div id="modalRubah<?= $mapel->id ?>" class="modal fade" role="dialog">


                                <div class="modal-dialog">


                                    <!-- Modal content-->


                                    <div class="modal-content">


                                        <div class="modal-header">


                                            <button type="button" class="close" data-dismiss="modal">&times;</button>


                                            <h4 class="modal-title">Rubah Data Tingkat Mata Pelajaran</h4>


                                        </div>


                                        <form action="<?= base_url('index.php/admin/rubahtingkatMP') ?>" method="post">


                                            <div class="modal-body">


                                                <div class="form-group input-group">


                                                    <span class="input-group-addon"><i class="ico-notebook"></i></span>


                                                    <input name="keterangan" id="keterangan" type="text" class="form-control" value="<?= $mapel->keterangan ?>" placeholder="Keterangan Mata Pelajaran" required> <br>


                                                    <input name="idtingkatMP" type="hidden" value="<?= $mapel->id ?>" >





                                                </div>


                                                <div class="form-group input-group">


                                                    <span class="input-group-addon"><i class="ico-notebook"></i></span>


                                                    <select class="form-control" name="tingkatMP">


                                                        <option>Pilih Tingkat Mata Pelajaran</option>> 


                                                        <option value="<?= $mapel->tingkatID ?>" selected> 


                                                          
                                                            <?php


                                                            if ($mapel->tingkatID == 1) {


                                                                echo 'SD';


                                                            } else if ($mapel->tingkatID == 2) {


                                                                echo 'SMP';


                                                            } else if ($mapel->tingkatID == 3) {


                                                                echo 'SMA ';


                                                            } else if ($mapel->tingkatID == 4) {


                                                                echo 'SMA - IPA';


                                                            } else if ($mapel->tingkatID == 5) {


                                                                echo 'SMA - IPS';


                                                            }else {


                                                                echo 'Tidak mempunyai tingkatan';


                                                            }


                                                            ?> </option>


                                                        <option value="1">SD</option>


                                                        <option value="2">SMP</option>


                                                        <option value="3">SMA</option>


                                                        <option value="4">SMA - IPA</option>

                                                        <option value="5">SMA - IPS</option>

                                                    </select>


                                                </div>


                                                <div class="form-group input-group">


                                                    <span class="input-group-addon"><i class="ico-notebook"></i></span>


                                                    <select class="form-control" name="idMP">


                                                        <option>Pilih Mata Pelajaran</option>


                                                        <option value="<?= $mapel->matapelajaranID ?>" selected> <?= $mapel->namaMataPelajaran ?></option>


                                                        <?php foreach ($mapels as $mapel): ?>


                                                            <option value="<?= $mapel->id ?>"><?= $mapel->namaMataPelajaran ?></option>


                                                        <?php endforeach ?>


                                                    </select>


                                                </div>


                                            </div>


                                            <div class="modal-footer">


                                                <button type="submit" class="btn btn-primary">Simpan</button>


                                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>


                                            </div>


                                        </form>


                                    </div>


                                </div>


                            </div>


                        <?php endforeach ?>


                        </tbody>


                    </table>


                </div>


                <div class="tab-pane" id="tingkatSMA-IPA">


                    <!--<table class="table table-striped" id="mapelsma" style="font-size: 13px">-->


                    <table id="" class="table table-striped display" cellspacing="0" width="100%">


                        <thead>


                            <tr>


                                <th class="text-center">ID</th>


                                <th>Nama Mata Pelajaran</th>


                                <th>Keterangan</th>


                                <th>BAB</th>


                                <th class="text-center">Aksi</th>


                            </tr>


                        </thead>


                        <tbody>


                            <?php foreach ($mapelsmaipa as $mapel): ?>


                                <tr>


                                    <td class="text-center"><?= $mapel->id ?></td>


                                    <td><?= $mapel->namaMataPelajaran ?></td>


                                    <td><?= $mapel->keterangan ?></td>


                                    <td><a href="<?= base_url('index.php/admin/daftarbab/' . $mapel->namaMataPelajaran . '/' . $mapel->id); ?>" class="btn btn-default">Lihat</a></td>


                                    <td class="text-center">


                                        <button type="button" id="rubahBtn" class="btn btn-default" data-toggle="modal" data-target="#modalRubah<?= $mapel->id ?>" title="Rubah Data"><i class="ico-file5"></i></button>


                                        <button type="button" id="hapusBtn" class="btn btn-default" data-toggle="modal" data-id="<?= $mapel->id ?>" title="Hapus Data"><i class="ico-remove"></i></button>


                                    </td>


                                    <!-- Modal -->


                                </tr>


                            <div id="modalRubah<?= $mapel->id ?>" class="modal fade" role="dialog">


                                <div class="modal-dialog">


                                    <!-- Modal content-->


                                    <div class="modal-content">


                                        <div class="modal-header">


                                            <button type="button" class="close" data-dismiss="modal">&times;</button>


                                            <h4 class="modal-title">Rubah Data Tingkat Mata Pelajaran</h4>


                                        </div>


                                        <form action="<?= base_url('index.php/admin/rubahtingkatMP') ?>" method="post">


                                            <div class="modal-body">


                                                <div class="form-group input-group">


                                                    <span class="input-group-addon"><i class="ico-notebook"></i></span>


                                                    <input name="keterangan" id="keterangan" type="text" class="form-control" value="<?= $mapel->keterangan ?>" placeholder="Keterangan Mata Pelajaran" required> <br>


                                                    <input name="idtingkatMP" type="hidden" value="<?= $mapel->id ?>" >





                                                </div>


                                                <div class="form-group input-group">


                                                    <span class="input-group-addon"><i class="ico-notebook"></i></span>


                                                    <select class="form-control" name="tingkatMP">


                                                        <option>Pilih Tingkat Mata Pelajaran</option>> 


                                                        <option value="<?= $mapel->tingkatID ?>" selected> 

  
                                                            <?php


                                                            if ($mapel->tingkatID == 1) {


                                                                echo 'SD';


                                                            } else if ($mapel->tingkatID == 2) {


                                                                echo 'SMP';


                                                            } else if ($mapel->tingkatID == 3) {


                                                                echo 'SMA ';


                                                            } else if ($mapel->tingkatID == 4) {


                                                                echo 'SMA - IPA';


                                                            } else if ($mapel->tingkatID == 5) {


                                                                echo 'SMA - IPS';


                                                            }else {


                                                                echo 'Tidak mempunyai tingkatan';


                                                            }


                                                            ?> </option>


                                                        <option value="1">SD</option>


                                                        <option value="2">SMP</option>


                                                        <option value="3">SMA</option>


                                                        <option value="4">SMA - IPA</option>

                                                        <option value="5">SMA - IPS</option>


                                                    </select>


                                                </div>


                                                <div class="form-group input-group">


                                                    <span class="input-group-addon"><i class="ico-notebook"></i></span>


                                                    <select class="form-control" name="idMP">


                                                        <option>Pilih Mata Pelajaran</option>


                                                        <option value="<?= $mapel->matapelajaranID ?>" selected> <?= $mapel->namaMataPelajaran ?></option>


                                                        <?php foreach ($mapels as $mapel): ?>


                                                            <option value="<?= $mapel->id ?>"><?= $mapel->namaMataPelajaran ?></option>


                                                        <?php endforeach ?>


                                                    </select>


                                                </div>


                                            </div>


                                            <div class="modal-footer">


                                                <button type="submit" class="btn btn-primary">Simpan</button>


                                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>


                                            </div>


                                        </form>


                                    </div>


                                </div>


                            </div>


                        <?php endforeach ?>


                        </tbody>


                    </table>


                </div>


                <div class="tab-pane" id="tingkatSMA-IPS">


                    <!--<table class="table table-striped" id="mapelsmk" style="font-size: 13px">-->


                    <table id="" class="table table-striped display" cellspacing="0" width="100%">


                        <thead>


                            <tr>


                                <th class="text-center">ID</th>


                                <th>Nama Mata Pelajaran</th>


                                <th>Keterangan</th>


                                <th>BAB</th>


                                <th class="text-center">Aksi</th>


                            </tr>


                        </thead>


                        <tbody>


                            <?php foreach ($mapelsmaips as $mapel): ?>


                                <tr>


                                    <td class="text-center"><?= $mapel->id ?></td>


                                    <td><?= $mapel->namaMataPelajaran ?></td>


                                    <td><?= $mapel->keterangan ?></td>


                                    <td><a href="<?= base_url('index.php/admin/daftarbab/' . $mapel->namaMataPelajaran . '/' . $mapel->id); ?>" class="btn btn-default">Lihat</a></td>


                                    <td class="text-center">


                                        <button type="button" id="rubahBtn" class="btn btn-default" data-toggle="modal" data-target="#modalRubah<?= $mapel->id ?>" title="Rubah Data"><i class="ico-file5"></i></button>


                                        <button type="button" id="hapusBtn" class="btn btn-default" data-toggle="modal" data-id="<?= $mapel->id ?>" title="Hapus Data"><i class="ico-remove"></i></button>


                                    </td>


                                    <!-- Modal -->


                            </tr>


                            <div id="modalRubah<?= $mapel->id ?>" class="modal fade" role="dialog">


                                <div class="modal-dialog">


                                    <!-- Modal content-->


                                    <div class="modal-content">


                                        <div class="modal-header">


                                            <button type="button" class="close" data-dismiss="modal">&times;</button>


                                            <h4 class="modal-title">Rubah Data Tingkat Mata Pelajaran</h4>


                                        </div>


                                        <form action="<?= base_url('index.php/admin/rubahtingkatMP') ?>" method="post">


                                            <div class="modal-body">


                                                <div class="form-group input-group">


                                                    <span class="input-group-addon"><i class="ico-notebook"></i></span>


                                                    <input name="keterangan" id="keterangan" type="text" class="form-control" value="<?= $mapel->keterangan ?>" placeholder="Keterangan Mata Pelajaran" required> <br>


                                                    <input name="idtingkatMP" type="hidden" value="<?= $mapel->id ?>" >





                                                </div>


                                                <div class="form-group input-group">


                                                    <span class="input-group-addon"><i class="ico-notebook"></i></span>


                                                    <select class="form-control" name="tingkatMP">


                                                        <option>Pilih Tingkat Mata Pelajaran</option>> 


                                                        <option value="<?= $mapel->tingkatID ?>" selected> 


                                                            
                                                            <?php


                                                            if ($mapel->tingkatID == 1) {


                                                                echo 'SD';


                                                            } else if ($mapel->tingkatID == 2) {


                                                                echo 'SMP';


                                                            } else if ($mapel->tingkatID == 3) {


                                                                echo 'SMA ';


                                                            } else if ($mapel->tingkatID == 4) {


                                                                echo 'SMA - IPA';


                                                            } else if ($mapel->tingkatID == 5) {


                                                                echo 'SMA - IPS';


                                                            }else {


                                                                echo 'Tidak mempunyai tingkatan';


                                                            }


                                                            ?> </option>


                                                        <option value="1">SD</option>


                                                        <option value="2">SMP</option>


                                                        <option value="3">SMA</option>


                                                        <option value="4">SMA - IPA</option>

                                                        <option value="5">SMA - IPS</option>

                                                    </select>


                                                </div>


                                                <div class="form-group input-group">


                                                    <span class="input-group-addon"><i class="ico-notebook"></i></span>


                                                    <select class="form-control" name="idMP">


                                                        <option>Pilih Mata Pelajaran</option>


                                                        <option value="<?= $mapel->matapelajaranID ?>" selected> <?= $mapel->namaMataPelajaran ?></option>


                                                        <?php foreach ($mapels as $mapel): ?>


                                                            <option value="<?= $mapel->id ?>"><?= $mapel->namaMataPelajaran ?></option>


                                                        <?php endforeach ?>


                                                    </select>


                                                </div>


                                            </div>


                                            <div class="modal-footer">


                                                <button type="submit" class="btn btn-primary">Simpan</button>


                                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>


                                            </div>


                                        </form>


                                    </div>


                                </div>


                            </div>


                        <?php endforeach ?>


                        </tbody>


                    </table>


                </div>


            </div>


        </div>


    </div>


</div>


<!-- Modal -->


<div id="myModal" class="modal fade" role="dialog">


    <div class="modal-dialog">





        <!-- Modal content-->


        <div class="modal-content">


            <div class="modal-header">


                <button type="button" class="close" data-dismiss="modal">&times;</button>


                <h4 class="modal-title">Tambah Data Tingkat Mata Pelajaran</h4>


            </div>


            <form action="<?= base_url('index.php/admin/tambahtingkatMP') ?>" method="post">


                <div class="modal-body">


                    <div class="form-group input-group">


                        <span class="input-group-addon"><i class="ico-notebook"></i></span>


                        <select class="form-control" name="idMP" required="">


                            <option value=""> Pilih Mata Pelajaran</option>


                            <?php foreach ($mapels as $mapel): ?>


                                <option value="<?= $mapel->id ?>"><?= $mapel->namaMataPelajaran ?></option>


                            <?php endforeach ?>


                        </select>


                    </div>


                    <div class="form-group input-group">


                        <span class="input-group-addon"><i class="ico-notebook"></i></span>


                        <select class="form-control" name="idTingkatMP" required="">


                            <option value=""> Pilih Tingkat Mata Pelajaran</option>


                            <option value="1">SD</option>


                            <option value="2">SMP</option>


                            <option value="3">SMA</option>


                            <option value="4">SMA IPA</option>


                            <option value="5">SMA IPS</option>


                        </select>


                    </div>


                    <div class="form-group input-group">


                        <span class="input-group-addon"><i class="ico-notebook"></i></span>


                        <input name="keterangan" type="text" class="form-control" placeholder="Keterangan Mata Pelajaran" required> <br>


                    </div>


                </div>


                <div class="modal-footer">


                    <button type="submit" class="btn btn-primary">Simpan</button>


                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>


                </div>


            </form>


        </div>


    </div>


</div>





<div id="modalHapus" class="modal fade" role="dialog">


    <div class="modal-dialog">


        Modal content


        <div class="modal-content">


            <div class="modal-header">


                <button type="button" class="close" data-dismiss="modal">&times;</button>


                <h4 class="modal-title">Hapus Data </h4>


            </div>


            <form action="<?= base_url('index.php/admin/hapustingkatMP') ?>" method="post">


                <div class="modal-body">


                    <div class="form-group input-group">


                        <span><h4 class="text-center">Yakin akan menghapus data mata pelajaran</h4></span>  


                        <input type="text" hidden="true" name="tingkatMP" id="tingkatMP" value=""/>


                    </div>


                </div>


                <div class="modal-footer">


                    <button type="submit" class="btn btn-primary">Yakin</button>


                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>


                </div>


            </form>


        </div>


    </div>


</div>





<!--/ END row -->


<script type="text/javascript">


//    $(document).on("click", "#rubahBtn", function () {


//        var nama = $(this).data('nama');


//        var tingkat = $(this).data('tingkat');


//        var ket = $(this).data('ket');


//        $(".rubah #namaMP").val(nama);


//        $(".rubah #tingkatMP").val(tingkat);


//        document.getElementById('day').innerHTML = "<option value='"+tingkat.d"+'>"+data.aliasTingkat+"</option>";


//


////        $(".rubah #tingkatMPoption").val(tingkat);


////        $(".rubah #tingkatMPtext").val(tingkat);


////        


////        $document.getElementById("pilihanTingkat").innerHTML("apapun");


//        $(".rubah #keterangan").val(ket);


//        // As pointed out in comments, 


//        // it is superfluous to have to manually call the modal.


//        $('#modalRubah').modal('show');


//    });





    $(document).on("click", "#hapusBtn", function () {


        var Id = $(this).data('id');


        $(".modal-body #tingkatMP").val(Id);


        // As pointed out in comments, 


        // it is superfluous to have to manually call the modal.


        $('#modalHapus').modal('show');


    });





    $(document).ready(function () {


        $('table.display').DataTable();


    });


</script>








