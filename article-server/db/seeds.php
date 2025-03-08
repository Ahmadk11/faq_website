<?php

require_once '../connection/connection.php';

$users = [
    ['fullName' => 'Ahmad Ahmad', 'email' => 'ahmad.ahmad@example.com', 'password' => 'password123'],
    ['fullName' => 'Ahmad Jad', 'email' => 'ahmad.jad@example.com', 'password' => 'password123'],
    ['fullName' => 'Ahmad Ali', 'email' => 'ahmad.ali@example.com', 'password' => 'password123']
];

foreach ($users as $user) {
    $fullName = $user['fullName'];
    $email = $user['email'];
    $password = password_hash($user['password'], PASSWORD_DEFAULT);
    
    $query = "INSERT INTO users (fullName, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $fullName, $email, $password);
    $stmt->execute();
}

$questions = [
    ['question' => 'What is the software development life cycle?', 'answer' => 'The software development life cycle is a conceptual framework that putline the stages involved in the development of a software application from initial feasibility stdu through deployment and maintenance.'],
    ['question' => 'What are three broad categories of SDLC models?', 'answer' => 'The three categories of SDLC models are, the first is Linear Models which is a sequential models where one stage leads to the next (e.g. Waterfall). The second is the Iterative Models which is a model the revisit earlier stages for continuous improvement (e.g. Spiral). The third one is Combined Models which is a mix of linear and iterative approaches.'],
    ['question' => 'How does the Waterfall Model work?', 'answer' => 'The Waterfall Model is a sequential development approach ehre progresses flows through predifined stages: Requirements, Design, Implementation, Testing, Deployment, and Maintenance. It was modified by Winston Royce to include feedback loops.'],
    ['question' => 'How does a model differ from a methodology in SDLC?', 'answer' => 'A model is descriptive and explains what to do, while a methodology is prescriptive and explains how to do it.'],
    ['question' => 'What improvement does the B-model introduce over the waterfall model?', 'answer' => 'The B-model extends the waterfall model by incorporating an operational lifecycle (maintenance cycle) to enable continuous improvements and avoid obsolescence.'],
    ['question' => 'What is the key difference between the spiral model and the waterfall model?', 'answer' => 'The spiral model is risk-driven and iterative, allowing for continuous feedback and risk assessment, whereas the waterfall model follows a strict sequential process.'],
    ['question' => 'What is the V-model, and how does it improve quality assurance?', 'answer' => 'The V-model is a variation of the waterfall model that integrates verification and validation processes at each stage to ensure that requirements and designs are verifiable.'],
    ['question' => 'How does the Unified Process Model differ from the waterfall and spiral models?', 'answer' => 'The Unified Process Model is model-based and use-case-driven, focusing on iterative development and incorporating object-oriented principles.'],
    ['question' => 'What are the key principles of Rapid Application Development (RAD)?', 'answer' => 'RAD emphasizes prototyping, iterative development, active user participation, and quick delivery by avoiding rigid planning.'],
    ['question' => 'What are some future considerations for SDLC models?', 'answer' => 'Future SDLC models may incorporate knowledge from other domains like behavior analysis, business management, and agile methodologies to improve efficiency and adaptability.'],
];


foreach ($questions as $question) {
    $questionText = $question['question'];
    $answer = $question['answer'];
    
    $query = "INSERT INTO questions (question, answer) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $questionText, $answer);
    $stmt->execute();
}

?>
