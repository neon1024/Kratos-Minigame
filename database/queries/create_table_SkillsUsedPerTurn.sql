CREATE EXTENSION IF NOT EXISTS "uuid-ossp";

CREATE TABLE IF NOT EXISTS SkillsUsedPerTurn
(
    turn_id  UUID NOT NULL,
    FOREIGN KEY (turn_id) REFERENCES Turns (id),

    skill_id UUID NOT NULL,
    FOREIGN KEY (skill_id) REFERENCES Skills (id),

    PRIMARY KEY (turn_id, skill_id)
);
