declare namespace App.Data {
export type AssetData = {
id: number;
name: string;
category: App.Data.CategoryData;
assignedUser: App.Data.AssignedUserData | null;
image: App.Data.ImageData | null;
};
export type AssignedUserData = {
firstName: string;
lastName: string;
};
export type CategoryData = {
id: number;
name: string;
};
export type ImageData = {
name: string;
url: string;
};
}
