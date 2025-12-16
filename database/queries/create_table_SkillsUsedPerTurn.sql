CREATE EXTENSION IF NOT EXISTS "uuid-ossp";

CREATE TABLE IF NOT EXISTS SkillsUsedPerTurn
(
    turn_id  UUID NOT NULL,
    skill_id UUID NOT NULL,

    FOREIGN KEY (turn_id) REFERENCES Turns (turn_id),
    FOREIGN KEY (skill_id) REFERENCES Skills (id)
);
