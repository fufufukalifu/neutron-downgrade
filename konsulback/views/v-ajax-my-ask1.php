                           
                              <!-- Start Pencarian tab 3 -->
                              <form action="" role="search">
                               <div class="has-icon">
                                <input type="text" class="form-control" placeholder="Search Pertanyaan one...">
                                <i class="ico-search form-control-icon"></i>
                              </div>
                            </form>
                            <hr>
                            <!-- END Pencarian tab3 -->
                            <!-- Start data pertanyaan guru-->
                         
                              <?php foreach ($my_questions as $question): ?>
                              <div class="media-list">
                               <a href="<?=base_url('konsultasi/singlekonsultasi/') ?><?=$question['pertanyaanID'] ?>" class="media border-dotted">
                                <span class="pull-left">
                                  <img src="<?=base_url("assets/image/photo/siswa/".$question['photo'])?>" class="img-circle" width="65px" height="65px" alt="">
                                </span>
                                <span class="media-body">
                                  <span class="media-heading"><?=$question['namaDepan']." ".$question['namaBelakang'] ?></span>
                                  <span class="media-text ellipsis nm"><?=$question['isiPertanyaan'] ?></span>
                                  <!-- meta icon -->
                                  <span class="media-meta"><i class=" ico-book3"></i><?=$question['judulSubBab'] ?></span>
                                  <span class="media-meta text-right">|<i class="ico-bubble2"></i><?=$question['jumlah'] ?></span>
                                  <span></span>
                                  <!--/ meta icon -->
                                </span>
                                <span class="pull-right">(<?=$question['date_created'] ?>)</span>
                              </a>
                            </div>
                          <?php endforeach ?>
                          <div class="mykonsul">
                             <nav class='text-center'>
                            <?php echo $pagination_links1; ?>
                            <!-- <ul class="pagination">
                              <li><a href="">1</a></li>
                              <li><a href="">2</a></li>
                              <li><a href="">3</a></li>
                            </ul> -->
                            </nav>
                          </div>

                            <!-- End data oertanyaan guru -->
                      
                         