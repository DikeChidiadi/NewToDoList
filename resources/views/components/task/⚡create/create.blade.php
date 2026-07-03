<div class="flex justify-center">
    <flux:card class="max-w-md space-y-3"> <!-- Mit max-w-* kann man die Breite der Karte einstellen -->
        <!-- Create a new task -->
        <form wire:submit.prevent="createTask">
            <flux:input.group> <!---- Mit input.group kann man ein Input-Element gruppieren -->
                <flux:input wire:model="addcontent" type="text" placeholder="What do you want to do?" required/>
                <flux:button type="submit" variant="primary" color="amber" icon="plus"/>
            </flux:input.group>
        </form>

        <flux:field>
            <!-- Each task has a unique ID -->
            <div class="flex justify-between mb-3">
                <flux:button class="w-38"/>

                <!-- Edit a task -->
                <flux:modal.trigger name="edit-task" class="flex gap-2">
                    <flux:button wire:click="editTask" variant="filled" icon="pencil"/>
                </flux:modal.trigger>

                <flux:modal name="edit-task" class="md:w-96">
                    <div class="space-y-6">
                        <div>
                            <flux:heading size="lg">Edit Task</flux:heading>
                        </div>
                        <flux:input placeholder="The Task"/>
                        <div class="flex">
                            <flux:spacer/>
                            <flux:button wire:click="updateTask" type="submit" variant="primary">Save changes</flux:button>
                        </div>
                    </div>
                </flux:modal>

                <!-- Delete a task -->
                <flux:modal.trigger name="delete-task">
                    <flux:button variant="danger" icon="trash"/>
                </flux:modal.trigger>

                <flux:modal name="delete-task" class="min-w-8">
                    <div class="space-y-8">
                        <div>
                            <flux:heading size="lg">Are you sure?</flux:heading>
                            <flux:text class="mt-2">
                                You're about to delete this task.<br>
                                This action cannot be undone.
                            </flux:text>
                        </div>
                        <div class="flex gap-2">
                            <flux:spacer/>

                            <flux:modal.close>
                                <flux:button variant="ghost">Cancel</flux:button>
                            </flux:modal.close>

                            <flux:button wire:click="deleteTask" type="submit" variant="danger">Delete project</flux:button>
                        </div>
                    </div>
                </flux:modal>
            </div>
        </flux:field>

        <!-- If there are no tasks -->
        <p class="text-center">No Todos to do!</p>
    </flux:card>
</div>