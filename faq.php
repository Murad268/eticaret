<div class="accordion" id="accordionExample">
   <h2 class="kargoWrapperMain__title">Sık Sorulan Sorular</h2>
   <div class="kargoWrapperMain__desc"> Aklınıza takılabileceğini düşündüyümüz soruların cevaplarını bu sayfada cevapladık. Fakat farklı bir sorunuz varsa ltüfen iletişim alanından bizlere iletiniz.</div>
   <?php
      $fetchQuestions = $db->prepare("SELECT * FROM faq");
      $fetchQuestions->execute();
      $questionsCount = $fetchQuestions->rowCount();
      $questions = $fetchQuestions->fetchAll(PDO::FETCH_ASSOC);
      if($questionsCount > 0) {
         foreach($questions as $question) {   
            if($question["indexId"] == "first") { ?>
             <div class="accordion-item">
               <h2 class="accordion-header" id="<?=$question["id"]?>">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#<?=$question["indexId"]?>" aria-expanded="true" aria-controls="<?=$question["indexId"]?>">
                  <?=$question["question"]?>
                  </button>
               </h2>
               <div id="<?=$question["indexId"]?>" class="accordion-collapse collapse show" aria-labelledby="<?=$question["id"]?>" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                  <?=$question["answer"]?>
                  </div>
               </div>
            </div>
         <?php  } else { ?>
            <div class="accordion-item">
               <h2 class="accordion-header" id="<?=$question["id"]?>">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#<?=$question["indexId"]?>" aria-expanded="true" aria-controls="<?=$question["indexId"]?>">
                  <?=$question["question"]?>
                  </button>
               </h2>
               <div id="<?=$question["indexId"]?>" class="accordion-collapse collapse" aria-labelledby="<?=$question["id"]?>" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                  <?=$question["answer"]?>
                  </div>
               </div>
            </div>
            <?php }
            ?>
           
   <?php }
      }
   ?>



</div>