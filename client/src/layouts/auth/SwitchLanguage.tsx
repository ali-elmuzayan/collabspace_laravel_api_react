import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select";

const languages = [
  { label: "English", value: "en" },
  { label: "Arabic", value: "ar" },
];
const SwitchLanguage = () => {
  return (
    <Select items={languages}>
      <SelectTrigger className="w-22  text-xs text-gray-500 bg-gray-100 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
        <SelectValue className="text-xs" placeholder="English" />
      </SelectTrigger>
      <SelectContent className="mr-4 mt-1">
        {languages.map((language) => (
          <SelectItem
            key={language.value}
            value={language.value}
            className="text-xs text-gray-500 font-medium"
          >
            {language.label}
          </SelectItem>
        ))}
      </SelectContent>
    </Select>
  );
};

export default SwitchLanguage;
