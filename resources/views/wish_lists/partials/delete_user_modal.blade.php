<div id="delete-user-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-vertically-centered-modal-label">
    <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
        <div class="w-full flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto">
            <div class="flex justify-between items-center py-3 px-4 border-b border-gray-300">
                <h3 id="hs-vertically-centered-modal-label" class="font-bold text-gray-800">
                    Supprimer un utilisateur de la liste
                </h3>
                <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none" data-hs-overlay="#delete-user-modal">
                    <span class="sr-only">Close</span>
                    <x-lucide-x class="w-4 h-4 shrink-0"/>
                </button>
            </div>
            <div class="p-4 overflow-y-auto">
                <p class="text-gray-800">
                    Êtes-vous sûr de vouloir supprimer cet utilisateur de la liste ?
                </p>
            </div>
            <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-gray-300">
                <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" data-hs-overlay="#delete-user-modal">
                    Annuler
                </button>
                <form id="delete-user-form" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button
                        type="submit"
                        id="delete-user-button"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-none focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none"
                    >
                        <span class="indicator-label">
                            Supprimer
                        </span>
                        <span class="hidden flex justify-center items-center indicator-progress">
                            Veuillez patienter... <x-lucide-loader-circle class="w-6 h-6 ms-2 animate-spin" />
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Suppression d'un cadeau
    const deleteUserForm = document.querySelector('#delete-user-form')
    deleteUserForm.addEventListener('submit', function(e) {
        e.preventDefault()

        // Bouton anti spam
        activateButtonIndicator(deleteUserButton)

        deleteUserForm.submit()
    });
</script>
