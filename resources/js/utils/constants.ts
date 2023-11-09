import { nanoid } from "nanoid";

export const EMPTY_STOP: Models.Stop & {arrives_at: string} = {
  id: nanoid(),
  name: "",
  link: null,
  arrives_at: "08:00",
} as const;