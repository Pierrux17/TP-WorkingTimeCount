document.addEventListener('DOMContentLoaded', () => {
    const startButton = document.getElementById('start-button');
    startButton.disabled = true;
    const stopButton = document.getElementById('stop-button');
    const restartButton = document.getElementById('restart-button');
    const validButton = document.getElementById('validate-button');
    const timeDiv = document.getElementById('time');
    const descriptionTextarea = document.getElementById('txt-description');
    const nomClientText = document.getElementById('nomClient');
    const pStandard = document.getElementById('p_standard');
    const pNuit = document.getElementById('p_nuit');
    const pFerie = document.getElementById('p_ferie');
    const pTeletravail = document.getElementById('p_teletravail');
    
    const selectedClient = document.getElementById('ListeClient');
    const chooseClientButton = document.getElementById("chooseButton");

    let idClient;
    let startTime;
    let interval;
    let elapsedTime;
    let restartTime = 0;
  
    function startTimer() {
      startButton.disabled = true;
      stopButton.disabled = false;
      restartButton.disabled = true;
      validButton.disabled = true;
      // restartTime = Date.now() - startTime;
      startTime = Date.now();
      interval = setInterval(updateTime, 1000);
      console.log("Start");
    }
  
    function stopTimer() {
      startButton.disabled = false;
      stopButton.disabled = true;
      restartButton.disabled = false;
      validButton.disabled = false;
      clearInterval(interval);
      interval = null
      startButton.textContent = "Recommencer";
      console.log("stop Timer");
    }
  
    function updateTime() {
      elapsedTime = Date.now() - startTime;
      const seconds = `0${Math.floor(elapsedTime / 1000) % 60}`.slice(-2);
      const minutes = `0${Math.floor(elapsedTime / 1000 / 60) % 60}`.slice(-2);
      const hours = `0${Math.floor(elapsedTime / 1000 / 60 / 60)}`.slice(-2);
      timeDiv.textContent = `${hours}:${minutes}:${seconds}`;
      console.log(timeDiv);
    }

    function restartTimer() {
      startButton.disabled = true;
      stopButton.disabled = false;
      restartButton.disabled = true;
      validButton.disabled = true;
      startTime = Date.now() - elapsedTime;
      interval = setInterval(updateTime, 1000);
      console.log("Restart");
    }


    //VALIDE LE TEMPS ET ENVOIE LES DONNEES POUR LES METTRE DANS LA DB --> OK

    function valideTimer(){
      clearInterval(interval);
      startButton.disabled = false;
      stopButton.disabled = true;
      validButton.disabled = true;

      let time = timeDiv.textContent;
      let idSelectedClient = selectClient();
      let description = descriptionTextarea.value;
      let idPrestation;
      
      if(pStandard.checked == true){
        idPrestation = pStandard.value;
      }
      if(pNuit.checked == true){
        idPrestation = pNuit.value;
      }
      if(pFerie.checked == true){
        idPrestation = pFerie.value;
      }
      if(pTeletravail.checked == true){
        idPrestation = pTeletravail.value;
      }

      console.log(time);
      console.log("Id du client : " + idSelectedClient);
      console.log("Description : " + description);
      console.log("Id de la prestation : " + idPrestation);

      $.ajax({
        type: 'POST',
        url: 'pageEmploye.php',
        data: { time: time, idClient: idSelectedClient, description: description, idPrestation: idPrestation},
        success: function(response){                                           
          alert("Compteur Validé");
        },
        error: function(response){
          alert("Erreur : Compteurs non Validé");
          console.log(response);
        }
      });
    }
    

    //RETOURNE L'ID DU CLIENT --> OK

    function selectClient() {
      startButton.disabled = false;
      let selectedOption = selectedClient.options[selectedClient.selectedIndex];
      idClient = selectedOption.value;

      if (selectedOption.text !== "-- Sélectionnez un client --") { // Ajoute cette condition
        nomClientText.textContent = idClient + " : " + selectedOption.text;
      } else {
        nomClientText.textContent = "";
      }
      
      console.log(idClient);
      return idClient;
    }

    //DEMARRER, ARRETER ET VALIDER LE TIMER
    startButton.addEventListener('click', startTimer);
    stopButton.addEventListener('click', stopTimer);
    restartButton.addEventListener('click', restartTimer);
    validButton.addEventListener('click', valideTimer);

    //CHOISIR LE CLIENT
    chooseClientButton.addEventListener('click', selectClient);
})

