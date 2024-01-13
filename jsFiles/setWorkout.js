document.addEventListener('DOMContentLoaded', () => {
    const exercises = []

    const startTrainingBtn = document.querySelector('.startTraining')
    const trainingBox = document.querySelector('.trainingBox')
    const addExerciseBtn = document.querySelector('.addExerciseBtn')
    const resetBtn = document.querySelector('.resetBtn')
    const saveTrainingBtn = document.querySelector('.saveTrainingBtn')
    const exerciseList = document.querySelector('.exerciseList')
    const trainingPreview = document.querySelector('.trainingPreview')

    const resetTrainingStatue = () => {
        exerciseList.innerHTML = ''
        trainingPreview.innerHTML = ''
        exercises.length = 0
        trainingBox.classList.add('hidden')
        startTrainingBtn.classList.remove('hidden')
    }

    const resetTraining = () => {
        exerciseList.innerHTML = ''
        trainingPreview.innerHTML = ''
        exercises.length = 0
    }

    const startTraining = () => {
        trainingBox.classList.remove('hidden')
        startTrainingBtn.classList.add('hidden')
    }

    const createExercise =()=>{
        const exerciseDiv = document.createElement('div')

        const exerciseNameInput = document.createElement('input')
        exerciseNameInput.placeholder = 'Nazwa ćwiczenia'

        const addSetBtn = document.createElement('button')
        addSetBtn.innerHTML = '<i class="fas fa-plus"></i>'

        const deleteExerciseBtn = document.createElement('button')
        deleteExerciseBtn.innerHTML = '<i class="fas fa-trash-alt"></i>'

        deleteExerciseBtn.addEventListener('click', () => {
            exerciseList.removeChild(exerciseDiv)
          })

        const setsDiv = document.createElement('div')

        addSetBtn.addEventListener('click', () => {
            const setDiv = document.createElement('div')

            const repsInput = document.createElement('input')
            repsInput.placeholder = 'Liczba powtórzeń'
            repsInput.classList.add('reps')

            const weightInput = document.createElement('input')
            weightInput.placeholder = 'Ciężar'
            weightInput.classList.add('weight')

            const deleteSetBtn = document.createElement('button')
            deleteSetBtn.innerHTML = '<i class="fas fa-trash-alt"></i>'

            deleteSetBtn.addEventListener('click', () => {
                setsDiv.removeChild(setDiv)
            })

            setDiv.append(repsInput,weightInput,deleteSetBtn)
            setsDiv.append(setDiv)
    })

    deleteExerciseBtn.addEventListener('click', function () {
      exerciseList.removeChild(exerciseDiv)
    });

    exerciseDiv.append(exerciseNameInput,addSetBtn,deleteExerciseBtn,setsDiv)
    exerciseList.append(exerciseDiv)
}

    const saveTraining = () => {
        document.querySelectorAll('.exerciseList > div').forEach((exerciseDiv) => {
            const exerciseNameInput = exerciseDiv.querySelector('input')
            const setsDiv = exerciseDiv.querySelector('div')
            const sets = []

            setsDiv.querySelectorAll('div').forEach((setDiv) => {
                const repsInput = setDiv.querySelector('.reps')
                const weightInput = setDiv.querySelector('.weight')

                if(repsInput.value && weightInput.value){
                    const set = {
                        reps : repsInput.value,
                        weight : weightInput.value
                    }

                    sets.push(set)
                }
            })

            if(exerciseNameInput.value && sets.length > 0){
                const exercise = {
                    name:exerciseNameInput.value,
                    sets: sets
                }

                exercises.push(exercise)
            }  
        })
        const trainingData = JSON.stringify(exercises)
        fetch('../phpFiles/saveWorkout.php', {
            method: "POST",
            headers: {
                "Content-type":'application/json'
            },
            body: trainingData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`Błąd HTTP! Status: ${response.status}`);
            }
            return response.json();
        })
        .catch(error => {
            const err = document.createElement('h1')
            err.textContent = "Błąd podczas dodawania treningu"
            document.querySelector('main').append(err)
            return error;
        })
        
        resetTrainingStatue()
    }

    

    startTrainingBtn.addEventListener('click', startTraining)
    resetBtn.addEventListener('click', resetTraining)
    addExerciseBtn.addEventListener('click', createExercise)
    saveTrainingBtn.addEventListener('click', saveTraining)
})