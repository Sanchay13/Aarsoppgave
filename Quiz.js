const questions = [ // Definer en liste over spørsmål og svaralternativer
        {
        question: "Hvilke matretter pleier vi å ha på fredager?",
        answers: [
            {text: "Kebab", correct: false},
            {text: "Fish and Chips", correct: true},
            {text: "Taco", correct: false},
            {text: "Lasagne", correct: false},
        ]
        },

        {
            question: "Hva gjør du om du har noe spørmsål relatert til nettsiden vår?",
            answers: [
                {text: "Sender melding til sjefen", correct: false},
                {text: "Stiller spørsmål på FAQ siden hvis du føler at den er relevant for alle", correct: true},
                {text: "Ikke si noe", correct: false},
                {text: "Spørre andre", correct: false},
            ]
        },

        {
            question: "Hvordan legge produkter på nettsiden vår?",
            answers: [
                {text: "Gå til legg til produkt siden og taste inn informasjon på input-feltene", correct: true},
                {text: "Du kan ikke siden du ikke har disse privilegiene", correct: false},
                {text: "Jeg vet ikke", correct: false},
                {text: "Bare hopp over", correct: false},
            ]
        },

        {
            question: "Hva er kuben spesialiten på torsdager",
            answers: [
                {text: "Pizza", correct: false},
                {text: "Kake", correct: false},
                {text: "Taco", correct: false},
                {text: "Kebab", correct: true},
            ]
        },



];
// Finn HTML-elementene vi trenger å oppdatere i JavaScript
const questionElement = document.getElementById("question");
const answerButton = document.getElementById("answer-buttons");
const nextButton = document.getElementById("next-btn"); 

// Definer variabler for å holde styr på nåværende spørsmål og poengsum
let currentQuestionIndex = 0; 
let score = 0;


//Denne funksjonen starter quizen. Når denne funksjonen blir kalt, blir verdien av variablene currentQuestionIndex og score satt til 0. Deretter blir teksten på knappen med id next-btn satt til "Next". Til slutt blir funksjonen showQuestion() kalt for å vise det første spørsmålet og svaralternativene.
function startQuiz() {
    currentQuestionIndex = 0;
    score = 0;
    nextButton.innerHTML = "Next";
    showQuestion();
}


//Denne funksjonen viser spørsmålet som er lagret i objektet questions på nettsiden og oppretter knapper for svaralternativene.

//Funksjonen starter med å kalle på resetState-funksjonen, som tømmer svarknappene og skjuler "Next"-knappen. Deretter henter funksjonen spørsmålet som skal vises fra questions-objektet ved å bruke indeksen som er lagret i currentQuestionIndex.

//Deretter henter funksjonen også spørsmålsnummeret og legger til det i HTML-koden sammen med spørsmålsteksten.

//Videre oppretter funksjonen en knapp for hvert svaralternativ ved hjelp av forEach-funksjonen. Hver knapp blir gitt svaralternativets tekst som innhold, en klasse og lagt til i svarknappene. Hvis svaralternativet er riktig, blir correct-attributtet satt til true på knappen. Til slutt legger funksjonen til en "click"-hendelse på knappen som kaller selectAnswer-funksjonen.
function showQuestion() {
    resetState();
    let currentQuestion = questions[currentQuestionIndex];
    let questionNo = currentQuestionIndex + 1;
    questionElement.innerHTML = questionNo + ". " + currentQuestion.question;

    currentQuestion.answers.forEach(answer => { 
        const button = document.createElement("button");
        button.innerHTML = answer.text;
        button.classList.add("btn");
        answerButton.appendChild(button); 
        if(answer.correct){
            button.dataset.correct = answer.correct;
        }
        button.addEventListener("click", selectAnswer);
    });
}

function resetState() {
    nextButton.style.display = "none";
    while(answerButton.firstChild){ // så lenge det eksister en firstchild element da skal den fjernes fra array answerbuttons.
        answerButton.removeChild(answerButton.firstChild);
    }
}

//selectAnswer-funksjonen blir kalt når brukeren velger et svaralternativ. Funksjonen tar inn e-parameteren, som representerer hendelsen som ble utløst, og deretter velger den knappen som brukeren trykket på.

//Funksjonen sjekker om knappen som ble valgt, er det riktige svaret eller ikke. Hvis det er det riktige svaret, legger funksjonen til en klasse på knappen for å indikere at svaret er riktig, og øker poengsummen med en. Hvis det ikke er det riktige svaret, legger funksjonen til en klasse på knappen for å indikere at svaret er feil.

//Funksjonen deaktiverer alle svaralternativene, slik at brukeren ikke kan velge et annet alternativ etter at de har valgt et svar. Hvis det riktige svaret er blant alternativene, legger funksjonen til en klasse på det riktige svaret for å indikere at det var riktig.

//Til slutt vises knappen for å gå til neste spørsmål.

function selectAnswer(e){
    const selectedBtn = e.target;
    const isCorrect = selectedBtn.dataset.correct === "true";
    if(isCorrect){
        selectedBtn.classList.add("correct");
        score++;
    } else{
        selectedBtn.classList.add("incorrect");
    }
    Array.from(answerButton.children).forEach(button => {
        if(button.dataset.correct === "true"){
            button.classList.add("correct");
    }
    button.disabled = true; 
});
nextButton.style.display = "block";
}

// Funksjonen starter med å resette svaralternativene for å vise poengsummen når quizen er over. Dermed vises button spill igjen. 
function showScore(){
    resetState();
    questionElement.innerHTML = `You scored ${score} out of ${questions.length}`;
    nextButton.innerHTML = "Play Again";
    nextButton.style.display = "block";

}
function handlenextButton(){ // Hvis det er et annet spørsmål så vises dette hvis ikke så displayes bare score når vi velger nextbutton
    currentQuestionIndex++;
    if(currentQuestionIndex < questions.length){
        showQuestion();
    } else{
        showScore();
    }
    
}
nextButton.addEventListener("click", () => { // en eventlistener som blir kalt når brukeren trykkes på knappen. Hvis spørsmål sin length er under antall spørsmål skal neste spørsmål vises ellers skal quizen starte på nytt.
    if(currentQuestionIndex < questions.length){
        handlenextButton()
} else{
    startQuiz()
}
})

startQuiz()
// Quizen startes med engang pagen loades og overwriter html-en.