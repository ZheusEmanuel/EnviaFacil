CREATE TABLE alunos (
    matricula INT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    curso VARCHAR(50),
    email VARCHAR(100) UNIQUE
);

CREATE TABLE cra (
    matricula INT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    setor VARCHAR(50),
    email VARCHAR(100) UNIQUE
);