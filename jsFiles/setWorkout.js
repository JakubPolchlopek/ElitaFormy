const addWorkoutBtn = document.querySelector('.add-workout_btn');
const addExerciesBtn = document.querySelector('.add-exercise_btn');
const addExerciesBox = document.querySelector('.add-ex_box');
let workouts = [];
let exs = ["cw1", "cw2"];

const addExercise = () => {
    const exBox = document.createElement('div');
    const exTitle = document.createElement('select')
    exs.forEach(ex => {
        const opt = document.createElement('option')
        opt.value = ex
        opt.textContent = ex
        exTitle.append(opt)
    });
    
    const exercise = {
        title: '',
        series: 0
    };

    const addRound = document.createElement('button');
    addRound.textContent = 'Dodaj serię';
    addRound.addEventListener('click', () => createRound(exBox, exercise));
    
    const saveEx = document.createElement('button');
    saveEx.textContent = "Zapisz ćwiczenie";
    saveEx.addEventListener('click', () => saveExercise(exercise));
    
    exBox.append(exTitle, addRound, saveEx);
    addExerciesBox.append(exBox);
};

const createRound = (box, exercise) => {
    const seriesNum = document.createElement('p');
    exercise.series++;
    seriesNum.textContent = `Seria nr ${exercise.series}`;
    const weight = document.createElement('input');
    weight.type = 'number';
    weight.placeholder = 'Wprowadź ciężar';
    box.append(seriesNum, weight);
};

const saveExercise = (exercise) => {
    exercise.title = exercise.title || 'Brak nazwy';
    workouts.push(exercise);
    console.log('Zapisano ćwiczenie:', exercise);
    resetForm();
};

const resetForm = () => {
    addExerciesBox.innerHTML = '';
};

addWorkoutBtn.addEventListener('click', () => {
    addExerciesBox.style.display = 'block';
    addWorkoutBtn.style.display = 'none';
});

addExerciesBtn.addEventListener('click', addExercise);
