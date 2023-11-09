import { nanoid } from "nanoid";

export const EMPTY_STOP: Resources.StopResource = {
  id: nanoid(),
  name: "",
  link: null,
  arrives_at: "08:00",
} as const;