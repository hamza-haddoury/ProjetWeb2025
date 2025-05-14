<?php
session_start();

$loggedIn = isset($_SESSION['login']);
$username = $loggedIn ? $_SESSION['login'] : null;

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q-Sport | Prove Your Sports Expertise</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="./css/styles2.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<header class="header-gradient">
    <div class="header-content">
        <h1 class="logo animate__animated animate__fadeInLeft">QSport</h1>
        <nav class="animate__animated animate__fadeInRight">
            <?php if ($loggedIn): ?>
                <div class="user-info">
                    <span class="username"><?= htmlspecialchars($username) ?></span>
                </div>
                <a href="logout.php" class="nav-btn logout-btn">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="nav-btn login-btn">Login</a>
                    <a href="register.php" class="nav-btn register-btn">Register</a>
            <?php endif; ?>
        </nav>
    </div>
</header>
    
<main class="main-content">
    <?php if ($loggedIn): ?>
        <section class="hero animate__animated animate__fadeIn" >
            <div id="wM">
                <div class="hero-text">
                    <h2>Welcome back, <span class="highlight"><?= htmlspecialchars($username) ?></span>!</h2>

                </div>
                <button id="startBtn" class="cta-button animate__animated animate__pulse animate__infinite">🚀 Start Quiz</button>
            </div>
        </section>
        <?php else: ?>
            <section class="hero guest-hero">
                <div class="hero-text">
                    <h2>Test Your <span class="highlight">Sports Knowledge</span></h2>
                    <p class="subtitle">Challenge yourself with our exciting sports quizzes!</p>
                </div>
                <div class="auth-buttons">
                    <a href="login.php" class="cta-button">Login to Play</a>
                    <a href="register.php" class="cta-button secondary">Register</a>
                </div>
            </section>
        <?php endif; ?>
        <div id="gameContainer" class="hidden">
            <section>
                <h2 class="section-title">Choose Your Sport</h2>
                <p class="section-subtitle">Select a category to begin your challenge</p>
                
                <div class="category-grid">
                    <div class="category-card" data-category="basketball">
                        <div class="category-image">
                            <img src="images/basketball.jpg" alt="Basketball">
                            <div class="overlay"></div>
                        </div>
                        <h3>Basketball</h3>
                    </div>
                    
                    <div class="category-card" data-category="boxe">
                        <div class="category-image">
                            <img src="images/boxing.jpg" alt="Boxing">
                            <div class="overlay"></div>
                        </div>
                        <h3>Boxing</h3>
                    </div>
                    
                    <div class="category-card" data-category="rugby">
                        <div class="category-image">
                            <img src="images/rugby.jpg" alt="Rugby">
                            <div class="overlay"></div>
                        </div>
                        <h3>Rugby</h3>
                    </div>
                    
                    <div class="category-card" data-category="olympics">
                        <div class="category-image">
                            <img src="images/athletics.jpg" alt="Olympics">
                            <div class="overlay"></div>
                        </div>
                        <h3>Olympics</h3>
                    </div>
                    
                    <div class="category-card" data-category="football">
                        <div class="category-image">
                            <img src="images/football.jpg" alt="Football">
                            <div class="overlay"></div>
                        </div>
                        <h3>Football</h3>
                    </div>
                    
                    <div class="category-card" data-category="formule1">
                        <div class="category-image">
                            <img src="images/Formula1.jpg" alt="Formula 1">
                            <div class="overlay"></div>
                        </div>
                        <h3>Formula 1</h3>
                    </div>
                </div>
            </section>
        </div>
        <div id="quizBox" class="hidden">
            <div id="questionBox">
                <h2 id="questionText" class="question-text"></h2>
                <div id="optionsContainer" class="options-grid"></div>
                <div id="timeLeft"></div>
            </div>
        </div>
    </div>
</main>

    <footer class="site-footer">
        <p>© 2025 QSport - Test your sports knowledge</p>
    </footer>



    <script>


        const startBtn = document.getElementById('startBtn');
        const gameContainer = document.getElementById('gameContainer');
        const quizContainer = document.getElementById('quizBox');
        const welcomeMessage= document.getElementById('wM');

        var test = {};
        let datas_ = {};
        let questions = [];
        let currentQuestion = 0;
   
        let timer;
        let timeLeft = 20;
        let bonneRep = 0;

        <?php if ($loggedIn): ?>
            startBtn.addEventListener('click', () => {
            // 1. Arrête l'animation pulsée du bouton
            startBtn.classList.remove('animate__pulse', 'animate__infinite');
    
            // 2. Fait disparaître TOUTE la section hero (message + bouton)
            const heroSection = document.querySelector('.hero'); // Cible la boîte parente
            heroSection.classList.add('animate__fadeOut'); // Animation de disparition
    
            // 3. Après l'animation, cache tout et affiche les catégories
            setTimeout(() => {
                heroSection.classList.add('hidden'); // Masquage permanent
                gameContainer.classList.remove('hidden');
                gameContainer.classList.add('animate__fadeIn');
            }, 500); // Durée synchronisée avec l'animation (0.5s)
        });
        <?php else: ?>
            startBtn.addEventListener('click', () => {
                window.location.href = "login.php?msg=Veuillez vous connecter pour jouer";
            });
        <?php endif; ?>
        
        document.querySelectorAll('.category-card').forEach(card => {
            card.addEventListener('click', () => {
                const category = card.dataset.category;
                console.log("Catégorie sélectionnée :", category);
                loadCategory(category);
                
                // Animation de sélection
                card.classList.add('animate__animated', 'animate__pulse');
                setTimeout(() => {
                    card.classList.remove('animate__animated', 'animate__pulse');
                }, 1000);
            });
        });

        function QuestionAuHasard(liste){

            const resultat = [];
            const listeCopie = [...liste]; 
            for(let i=0; i<10; i++){
                const j = Math.floor(Math.random() * listeCopie.length);
                const element = listeCopie.splice([j], 1)[0];
                resultat.push(element);
                

            }
            return resultat;

        }



        async function loadCategory(category) {
        
            fetch('./quizz.json')
                .then(res => {
                    if (!res.ok) throw new Error(`HTTP error! Status: ${res.status}`);
                    return res.json();
                })
                .then(data => {
                    console.log("Données chargées pour la catégorie :", category);


                    questions = QuestionAuHasard(data[category]);
                    gameContainer.classList.remove('flex');
                    gameContainer.classList.add("hidden");
                    quizContainer.classList.remove("hidden");
                
        
                    currentQuestion = 0;
                    loadQuestion();
                })
                .catch(err => console.error("Erreur dans le fetch :", err));
        }



        

        function loadQuestion() {
            console.log("compteur question : ", currentQuestion);
            if (currentQuestion >= questions.length) {
                return showFinalScore();
            }

            const q = questions[currentQuestion];
            document.getElementById("questionText").innerText = q.question;
            const optionsDiv = document.getElementById("optionsContainer");
            optionsDiv.innerHTML = '';

            q.options.forEach((option, index) => {
                const btn = document.createElement("button");
                btn.className = "option-btn";
                btn.innerHTML = `
                    <div class="option-icon">${String.fromCharCode(65 + index)}</div>
                    <span>${option}</span>
                `;
                btn.onclick = () => checkAnswer(option);
                optionsDiv.appendChild(btn);
            });

            timeLeft = 20;
            document.getElementById("timeLeft").innerText = timeLeft;
            clearInterval(timer);
            timer = setInterval(() => {
                timeLeft--;
                document.getElementById("timeLeft").innerText = timeLeft;
                if (timeLeft <= 0) {
                clearInterval(timer);
                currentQuestion++;
                loadQuestion();
                }
            }, 1000);
        }
        


        function checkAnswer(selected) {
            clearInterval(timer);
            const correct = questions[currentQuestion].answer;
            const options = document.querySelectorAll('.option-btn');
            
            options.forEach(option => {
                option.style.pointerEvents = 'none';
            });

            options.forEach(option => {
                const optionText = option.querySelector('span').textContent;
                if (optionText === correct) {
                    option.classList.add('correct');
                } else if (optionText === selected && selected !== correct) {
                    option.classList.add('incorrect');
                }
            });

            if (selected === correct) {
                bonneRep += 1;
            }

            setTimeout(() => {
                currentQuestion++;
                if (currentQuestion < questions.length) {
                    loadQuestion();
                } else {
                    showFinalScore();
                }
            }, 2000);
        }
            
        function showFinalScore() {

            document.getElementById("quizBox").innerHTML = `
                <h2>Partie terminée !</h2>
                <p>Score final : <strong>${bonneRep}</strong></p>
            
                <button onclick="window.location.reload()">Rejouer</button>
            `;
        }


        

        
        

    </script>




   

</body>
</html>
