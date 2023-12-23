<x-app-layout>
    <form class="p-4">
        <div class="relative inline-block">
          <div class="w-40 selectBox border border-gray-300 rounded" onclick="showCheckboxes()">
            <select class="w-full font-bold">
              <option>Select an option</option>
            </select>
            <div class="overSelect absolute inset-0"></div>
          </div>
          <div id="checkboxes" class="hidden border border-gray-300">
            <label for="one" class="block cursor-pointer hover:bg-blue-500 hover:text-white">
              <input type="checkbox" id="one" /> First checkbox
            </label>
            <label for="two" class="block cursor-pointer hover:bg-blue-500 hover:text-white">
              <input type="checkbox" id="two" /> Second checkbox
            </label>
            <label for="three" class="block cursor-pointer hover:bg-blue-500 hover:text-white">
              <input type="checkbox" id="three" /> Third checkbox
            </label>
          </div>
        </div>
      </form>
      
      <script>
        var expanded = false;
      
        function showCheckboxes() {28
          var checkboxes = document.getElementById("checkboxes");
          if (!expanded) {
            checkboxes.classList.remove("hidden");
            expanded = true;
          } else {
            checkboxes.classList.add("hidden");
            expanded = false;
          }
        }
      </script>
      

</x-app-layout>
