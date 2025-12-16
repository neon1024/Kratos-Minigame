CREATE EXTENSION IF NOT EXISTS "uuid-ossp";

CREATE TABLE IF NOT EXISTS Turns
(
    id                   UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
    game_id              UUID NOT NULL,

    FOREIGN KEY (game_id) REFERENCES Games (id) ON DELETE CASCADE,

    turn_number          INT,

    UNIQUE (game_id, turn_number),

    attacker             UUID,
    FOREIGN KEY (attacker) references Entities (id) ON DELETE SET NULL,

    defender             UUID,
    FOREIGN KEY (defender) references Entities (id) ON DELETE SET NULL,

    CHECK (attacker <> defender),

    defender_health_left NUMERIC(3, 2),
    damage_done          NUMERIC(3, 2)
);
