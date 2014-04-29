  		<div class="col-md-9 ">
              	<h2 id="sec0">Portal Notícias</h2>
                <div class="well publicidade">
                 <?php
                $publicidade = new Publicidade;
                $pub = $publicidade->listarPublicidade();
                 ?>
                 <img src="<?php echo  $pub[0]->publicidade_caminho ?>" alt="Publicidade">
                  <p><h5>As últimas notícias e fotos do Brasil e do mundo, política,
                 informações sobre trânsito, acidentes, previsão do tempo, vestibular e muito mais.</h5></p>
                </div>

              	<hr class="col-md-12">

              	<div class="row">
                  <div class="col-md-12">
                    <div class="panel panel-default">
                       <?php
                            $noticias->setId(1);
                            $noticias->setLimite(1);
                            $dados_destaque = $noticias->listarNoticiaDestaque();

                            foreach ($dados_destaque as $key => $destaque) : ?>
                      <div class="panel-heading"> <h3><a href="?p=noticia&id=<?php  echo $destaque->post_id ?>"><?php  echo $destaque->post_titulo; ?></a></h3></div>

                      <div class="panel-body">
                         <div id="principal">
                          <h2>Destaque</h2>

                            <div id="foto_destaque">
                                <img src="<?php  echo $destaque->post_foto ?>" alt="">
                            </div>
                            <div id="texto_destaque">
                                <?php  echo limitarCaracteres($destaque->post_conteudo, 800); ?><br />
                                <span class="Autor">Autor: <?php echo $destaque->adm_nome; ?> /
                                    Data: <?php echo date("d/m/Y", strtotime($destaque->post_data)); ?></span>
                            </div>
                            </div><!--principal-->
                            <?php  endforeach; ?>
                         </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <?php
                              $noticias->setId(2);
                              $noticias->setLimite(3);
                              $dados_destaque_secundario = $noticias->listarNoticiaDestaque();

                              foreach ($dados_destaque_secundario as $key => $secundario) : ?>
                      <div class="panel panel-default">

                      <div class="panel-heading"> <h2><?php  echo $secundario->categoria_nome; ?></h2></div>
                      <div class="panel-body">

                                       <h3><a href="?p=noticia&id=<?php  echo $secundario->post_id ?>"><?php  echo $secundario->post_titulo; ?></a></h3>
                                       <div id="texto_destaque">
                                      <?php  echo limitarCaracteres($secundario->post_conteudo, 450); ?><br />
                                      <span class="Autor">Autor: <?php echo $secundario->adm_nome; ?> /
                                          Data: <?php echo date("d/m/Y", strtotime($secundario->post_data)); ?></span>
                                      </div>

                           </div>
                    </div>
                          <?php  endforeach; ?>

                  </div>
              	</div>

              	<hr>

              <h4><a href="http://bootply.com/100993">Edit on Bootply</a></h4>
              	<hr>


      		</div>