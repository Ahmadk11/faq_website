document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.getElementById("login_form");

    loginForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const email = e.target.email.value;
        const password = e.target.password.value;

        const data = {
            email: email,
            password: password
        };

        try {
            const response = await axios.post('backend/login.php', data);

            if (response.data.message) {
                alert(response.data.message);
                window.location.href = 'home.html';
            } else {
                alert(response.data.error);
            }
        } catch (error) {
            console.error("Error during login:", error);
            alert("An error occurred. Please try again later.");
        }
    });
});

document.addEventListener("DOMContentLoaded", () => {
    const signupForm = document.getElementById("signup_form");

    signupForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const name = e.target.name.value;
        const email = e.target.email.value;
        const password = e.target.password.value;

        const data = {
            name: name,
            email: email,
            password: password
        };

        try {
            const response = await axios.post('backend/signup.php', data);

            if (response.data.message) {
                alert(response.data.message);
                window.location.href = 'home.html';
            } else {
                alert(response.data.error);
            }
        } catch (error) {
            console.error("Error during signup:", error);
            alert("An error occurred. Please try again later.");
        }
    });
});

const faqList = document.getElementById('faq-list');
const searchInput = document.getElementById('searchInput');

async function fetchQuestions() {
    try {
        const response = await axios.get('getQuestions.php');
        const data = response.data;

        if (data.questions) {
            renderQuestions(data.questions);
        } else {
            faqList.innerHTML = '<p>No questions found.</p>';
        }
    } catch (error) {
        console.error('Error fetching questions:', error);
        faqList.innerHTML = '<p>Error loading questions.</p>';
    }
}

function renderQuestions(questions) {
    faqList.innerHTML = '';

    questions.forEach(question => {
        const faqItem = document.createElement('div');
        faqItem.classList.add('faq-item');

        faqItem.innerHTML = `
            <h3 class="question">${question.question}</h3>
            <p class="answer">${question.answer}</p>
        `;
        
        faqList.appendChild(faqItem);
    });
}

function filterQuestions() {
    const query = searchInput.value.toLowerCase();
    const allFaqItems = faqList.getElementsByClassName('faq-item');

    Array.from(allFaqItems).forEach(item => {
        const questionText = item.querySelector('.question').textContent.toLowerCase();
        const answerText = item.querySelector('.answer').textContent.toLowerCase();

        if (questionText.includes(query) || answerText.includes(query)) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
}

searchInput.addEventListener('input', filterQuestions);

document.addEventListener('DOMContentLoaded', fetchQuestions);


document.getElementById("question-form").addEventListener("submit", async function(event) {
    event.preventDefault();

    const question = document.getElementById("question").value;
    const answer = document.getElementById("answer").value;

    if (question && answer) {
        try {
            const response = await fetch('backend/addQuestions.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ question: question, answer: answer })
            });

            const data = await response.json();

            if (data.message) {
                alert(data.message);
                window.location.href = "home.html";
            } else if (data.error) {
                alert(data.error);
            }
        } catch (error) {
            alert("Something went wrong, please try again.");
        }
    } else {
        alert("Please fill in both fields.");
    }
});
