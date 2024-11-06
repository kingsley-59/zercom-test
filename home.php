<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Candidates</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <main class="w-full max-w-[600px] mx-auto py-10 flex flex-col gap-5">
        <section class="w-full p-5 rounded-3xl bg-[#fcfcfc] shadow">
            <h2 class="text-3xl ">Student Data Summary</h2>

            <div class="grid grid-cols-3 gap-4">
                <div class="w-full rounded-xl shadow bg-white grid gap-3 p-4">
                    <span class="mx-auto text-lg font-bold text-gray">Science</span>
                    <span class="mx-auto text-4xl">4</span>
                </div>
                <div class="w-full rounded-xl shadow bg-white grid gap-3 p-4">
                    <span class="mx-auto text-lg font-bold text-gray">Art</span>
                    <span class="mx-auto text-4xl">5</span>
                </div>
                <div class="w-full rounded-xl shadow bg-white grid gap-3 p-4">
                    <span class="mx-auto text-lg font-bold text-gray">Commercial</span>
                    <span class="mx-auto text-4xl">1</span>
                </div>
            </div>
        </section>

        <section class="w-full p-5 rounded-3xl bg-[#fcfcfc] shadow">
            <h2 class="text-xl font-semibold mb-4 ">List of students and center names</h2>
            <table id="table1" class="table-auto w-full border bg-[#fff]">
                <thead>
                    <th>ID</th>
                    <th>Candidate Name</th>
                    <th>Centre Name</th>
                </thead>
                <tbody id="table1-body">

                </tbody>
            </table>
        </section>

        <section class="w-full p-5 rounded-3xl bg-[#fcfcfc] shadow">
            <h2 class="text-xl font-semibold mb-4 ">Student list based on category</h2>
            <form id="form2" class="flex justify-between items-center mb-4">
                <select name="category" id="category" class="px-4 py-2 rounded-md border">
                    <option value="1">Science</option>
                    <option value="2">Art</option>
                    <option value="3">Commercial</option>
                </select>
                <button type="submit" class="px-4 py-2 rounded-md border">Submit</button>
            </form>
            <table id="table2" class="table-auto w-full border bg-[#fff]">
                <thead>
                    <th>ID</th>
                    <th>Candidate Name</th>
                    <th>Centre Name</th>
                </thead>
                <tbody id="table2-body ">

                </tbody>
            </table>
        </section>

    </main>

    <script>
        async function fetchStudentsWithCentres() {
            try {
                const res = await fetch('http://localhost:8080/students/centre');
                const data = await res.json();
                console.log(data);
                return data;
            } catch (error) {
                alert('Api request error. Details in the console.');
            }
        }
        async function fetchStudentsBasedOnCategory(categoryId) {
            try {
                const res = await fetch('http://localhost:8080/students/category/' + categoryId);
                const data = await res.json();
                console.log(data);
                return data;
            } catch (error) {
                alert('Api request error. Details in the console.');
            }
        }

        fetchStudentsWithCentres()
            .then(result => {
                if (!Array.isArray(result)) {
                    console.log('Invalid data');
                }
                const table1 = document.getElementById('table1-body');
                for (const student of result) {
                    table1.insertAdjacentHTML('beforeend', `
                    <tr>
                        <td>${student?.id}</td>
                        <td>${student?.name}</td>
                        <td>${student?.centre_name}</td>
                    </tr>
                    `);
                }
            }).catch(console.error);

        document.getElementById('form2').addEventListener('submit', handleCategoryForm)

        function handleCategoryForm(e) {
            e.preventDefault();
            console.log('submitted');
            const categoryId = document.getElementById('category').value;

            // fetchStudentsBasedOnCategory(categoryId)
            //     .then(result => {
            //         if (!Array.isArray(result)) {
            //             console.log('Invalid data');
            //         }
            //         const table1 = document.getElementById('table2-body');
            //         for (const student of result) {
            //             table1.insertAdjacentHTML('beforeend', `
            //         <tr>
            //             <td>${student?.id}</td>
            //             <td>${student?.name}</td>
            //             <td>${student?.centre_name}</td>
            //         </tr>
            //         `);
            //         }
            //     }).catch(console.error);
        }
    </script>

</body>

</html>