<script setup>
import { router } from '@inertiajs/vue3';

const props = defineProps({
    message: String,
    turns: Array,
    gameStarted: Boolean
});

// Start or restart game
const startGame = () => {
    router.visit('/?start=1', {
        preserveScroll: false,
        preserveState: false,
        replace: true
    });
};
</script>

<template>
    <div class="min-h-screen bg-gray-100 text-gray-900 p-8">
        <div class="max-w-4xl mx-auto text-center">

            <!-- Start Game Button -->
            <button
                @click="startGame"
                class="px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white text-lg font-semibold rounded-lg shadow mb-10"
            >
                {{ gameStarted ? 'Start New Game' : 'Start Game' }}
            </button>

            <!-- If no game has been started, display nothing else -->
            <div v-if="!gameStarted" class="text-gray-500 text-lg mt-4">
                <!-- empty state intentionally shows nothing -->
            </div>

            <!-- After game starts, show results -->
            <div v-else>

                <!-- Winner Message -->
                <div class="bg-green-200 border border-green-500 text-green-900 px-5 py-4 rounded-lg mb-8 shadow text-left">
                    {{ message }}
                </div>

                <!-- Turns -->
                <div class="space-y-8">
                    <div
                        v-for="(turn, index) in turns"
                        :key="index"
                        class="bg-white rounded-xl shadow-lg p-6 border border-gray-200 text-left"
                    >
                        <h2 class="text-2xl font-semibold mb-4 text-gray-800">
                            Turn {{ turn.turn }}
                        </h2>

                        <div class="grid md:grid-cols-2 gap-6">

                            <!-- Attacker -->
                            <div class="bg-gray-50 border border-gray-300 rounded-lg p-4">
                                <h3 class="text-xl font-semibold mb-2 text-gray-800">Attacker</h3>
                                <p class="text-gray-700"><strong>Name:</strong> {{ turn.attacker_name }}</p>
                                <p class="text-gray-700"><strong>Health Start:</strong> {{ turn.attacker_health_start }}</p>
                                <p class="text-gray-700"><strong>Health End:</strong> {{ turn.attacker_health_end }}</p>
                            </div>

                            <!-- Defender -->
                            <div class="bg-gray-50 border border-gray-300 rounded-lg p-4">
                                <h3 class="text-xl font-semibold mb-2 text-gray-800">Defender</h3>
                                <p class="text-gray-700"><strong>Name:</strong> {{ turn.defender_name }}</p>
                                <p class="text-gray-700"><strong>Health Start:</strong> {{ turn.defender_health_start }}</p>
                                <p class="text-gray-700"><strong>Health End:</strong> {{ turn.defender_health_end }}</p>
                            </div>

                        </div>

                        <div class="mt-6 grid grid-cols-3 gap-6 text-center bg-gray-50 border border-gray-300 rounded-lg p-4">
                            <div>
                                <div class="text-xl font-bold text-gray-900">{{ turn.strikes }}</div>
                                <div class="text-gray-600">Strikes</div>
                            </div>

                            <div>
                                <div class="text-xl font-bold text-gray-900">{{ turn.dodges }}</div>
                                <div class="text-gray-600">Dodges</div>
                            </div>

                            <div>
                                <div class="text-xl font-bold text-gray-900">{{ turn.damage }}</div>
                                <div class="text-gray-600">Damage</div>
                            </div>
                        </div>

                        <div
                            v-if="turn.skills_used.length"
                            class="mt-6 bg-blue-50 border border-blue-300 rounded-lg p-4"
                        >
                            <strong class="text-blue-900 text-lg">Skills Used:</strong>
                            <ul class="list-disc ml-6 text-blue-800 mt-2">
                                <li v-for="(skill, i) in turn.skills_used" :key="i">
                                    {{ skill }}
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</template>
