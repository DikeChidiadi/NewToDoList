<div class="flex justify-center">
    <flux:card class="max-w-md space-y-3"> <!-- Mit max-w-* kann man die Breite der Karte einstellen -->
        <!-- Create a new todo -->
        <form wire:submit.prevent="createTodo">
            <flux:input.group> <!---- Mit input.group kann man ein Input-Element gruppieren -->
                <flux:input wire:model="addContent" type="text" placeholder="What do you want to do?" required />
                @error('addContent')
                    <span style="color: red;">{{ $message }}</span>
                @enderror
                <flux:button type="submit" variant="primary" color="amber" icon="plus" />
            </flux:input.group>
        </form>

        <flux:field>
            @forelse ($todos as $todo)
                <!-- Each todo has a unique ID -->
                <div class="flex justify-between mb-3">
                    <flux:button class="flex-1 justify-start truncate mr-2">{{ $todo->content }}</flux:button>

                    <!-- Edit a todo -->
                    <flux:modal.trigger name="edit-todo-{{ $todo->id }}" class="flex mr-2">
                        <flux:button wire:click.prevent="editTodo({{ $todo->id }})" variant="filled" icon="pencil" />
                    </flux:modal.trigger>

                    <flux:modal name="edit-todo-{{ $todo->id }}" class="md:w-96">
                        <div class="space-y-6">

                            <div>
                                <flux:heading size="lg">Edit Todo</flux:heading>
                            </div>
                            <flux:input wire:model="editContent" placeholder="The Todo" />
                            @error('editContent')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                            <div class="flex">
                                <flux:spacer />
                                <flux:modal.close>
                                    <flux:button wire:click="updateTodo({{ $todo->id }})" type="submit" variant="primary">
                                        Save changes</flux:button>
                                </flux:modal.close>
                            </div>
                        </div>
                    </flux:modal>


                    <!-- Delete a todo -->
                    <flux:modal.trigger name="delete-todo-{{ $todo->id }}">
                        <flux:button variant="danger" icon="trash" />
                    </flux:modal.trigger>

                    <flux:modal name="delete-todo-{{ $todo->id }}" class="min-w-8">
                        <div class="space-y-8">
                            <div>
                                <flux:heading size="lg">Are you sure?</flux:heading>
                                <flux:text class="mt-2">
                                    You're about to delete this todo.<br>
                                    This action cannot be undone.
                                </flux:text>
                            </div>
                            <div class="flex gap-2">
                                <flux:spacer />

                                <flux:modal.close>
                                    <flux:button variant="ghost">Cancel</flux:button>
                                    <flux:button wire:click="deleteTodo({{ $todo->id }})" type="submit" variant="danger">
                                        Delete project</flux:button>
                                </flux:modal.close>
                            </div>
                        </div>
                    </flux:modal>
                </div>
            @empty
                <p class="text-center">No Todos to do!</p>
            @endforelse
        </flux:field>

        <!-- If there are no todos -->

    </flux:card>
</div>